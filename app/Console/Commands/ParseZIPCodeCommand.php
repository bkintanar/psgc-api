<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ParseZIPCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psgc:parse-zipcode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse PhilPost Zip Codes';

    /**
     * The endpoint where we will get the zipcode from.
     */
    protected $endpoint = 'https://www.phlpost.gov.ph/zipcode-municipality.php';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = storage_path('zipcode-ids.csv');

        $rows = SimpleExcelReader::create($filePath)->getRows();

        $rows->each(function (array $properties) {
            $data = [
                'id' => 'Cebu',
            ];

            $this->getZipCode($data);
        });
    }

    private function getZipCode($data)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post($this->endpoint, ['form_params' => $data]);

        $body = $response->getBody()->getContents();

        $stripped = strip_tags($body);

        $commaFixed = str_replace(' ,', ', ', $stripped);
        $result = str_replace('Result(s)', '', $commaFixed);
        $array = explode(PHP_EOL, trim(preg_replace('/\t+/', '', $result)));

        dd($array);
    }
}
