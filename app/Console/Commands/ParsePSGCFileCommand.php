<?php

namespace App\Console\Commands;

use App\Eloquent\City;
use App\Eloquent\Region;
use App\Eloquent\Barangay;
use App\Eloquent\District;
use App\Eloquent\Province;
use App\Eloquent\Municipality;
use Illuminate\Console\Command;
use App\Eloquent\SubMunicipality;
use Spatie\SimpleExcel\SimpleExcelReader;

class ParsePSGCFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psgc:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse PSGC Publication';

    protected $latest = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // source: https://psa.gov.ph/classification/psgc/
        $filePath = storage_path('psgc-mar2020.csv');

        $rows = SimpleExcelReader::create($filePath)->getRows();

        $rows->each(function (array $properties) {
            $data = [
                'code'         => $properties['Code'],
                'name'         => $properties['Name'],
                'level'        => $properties['Geographic Level'],
                'city_class'   => $properties['City Class'],
                'income_class' => $properties["Income\nClassification"],
                'urban_rural'  => $properties["Urban / Rural\n(based on 2015 POPCEN)"],
                'population'   => preg_replace('/\D+/', '', $properties["POPULATION\n(2015 POPCEN)"]),
            ];

            $data = array_filter($data);

            if (isset($data['level'])) {
                $methods = 'process'.$data['level'];

                $this->$methods($data);
            }
        });
    }

    private function processReg($data)
    {
        Region::create($data);

        $this->latest = Region::class;
    }

    private function processProv($data)
    {
        $data['region_id'] = Region::orderBy('id', 'desc')->pluck('id')->first();
        Province::create($data);

        $this->latest = Province::class;
    }

    private function processDist($data)
    {
        $data['region_id'] = Region::orderBy('id', 'desc')->pluck('id')->first();
        District::create($data);

        $this->latest = District::class;
    }

    private function processCity($data)
    {
        $region   = Region::orderBy('id', 'desc')->first();
        $province = Province::orderBy('id', 'desc')->first();
        $district = District::orderBy('id', 'desc')->first();

        $geographic = optional($district)->created_at > optional($province)->created_at ? $district : $province;

        // 099701000 &x 129804000
        if (in_array($data['code'], ['099701000', '129804000'])) {
            $geographic = $region;
        }

        $data['geographic_type'] = get_class($geographic);
        $data['geographic_id'] = $geographic->id;
        City::create($data);

        $this->latest = City::class;
    }

    private function processSubMun($data)
    {
        $data['city_id'] = City::orderBy('id', 'desc')->pluck('id')->first();
        SubMunicipality::create($data);

        $this->latest = SubMunicipality::class;
    }

    private function processMun($data)
    {
        $geographic = Province::orderBy('id', 'desc')->first();

        if (in_array($data['code'], ['137606000'])) {
            $geographic = District::orderBy('id', 'desc')->first();
        }

        $data['geographic_type'] = get_class($geographic);
        $data['geographic_id'] = $geographic->id;

        Municipality::create($data);

        $this->latest = Municipality::class;
    }

    private function processBgy($data)
    {
        $latest = $this->latest;

        $geographic = (new $latest())->orderBy('id', 'desc')->first();

        $data['geographic_type'] = get_class($geographic);
        $data['geographic_id'] = $geographic->id;
        Barangay::create($data);
    }
}
