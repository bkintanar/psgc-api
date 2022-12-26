<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\CityController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\SubMunicipalityController;

Route::middleware('cache.headers:public;max_age=3600;etag')->group(function(){
    Route::get('regions', [RegionController::class, 'index'])->name('region.index');
    Route::get('regions/{region}', [RegionController::class, 'show'])->name('region.show');

    Route::get('provinces', [ProvinceController::class, 'index'])->name('province.index');
    Route::get('provinces/{province}', [ProvinceController::class, 'show'])->name('province.show');

    Route::get('districts', [DistrictController::class, 'index'])->name('district.index');
    Route::get('districts/{district}', [DistrictController::class, 'show'])->name('district.show');

    Route::get('cities', [CityController::class, 'index'])->name('city.index');
    Route::get('cities/{city}', [CityController::class, 'show'])->name('city.show');

    Route::get('municipalities', [MunicipalityController::class, 'index'])->name('municipality.index');
    Route::get('municipalities/{municipality}', [MunicipalityController::class, 'show'])->name('municipality.show');

    Route::get('sub-municipalities', [SubMunicipalityController::class, 'index'])->name('sub-municipality.index');
    Route::get('sub-municipalities/{subMunicipality}', [SubMunicipalityController::class, 'show'])->name('sub-municipality.show');

    Route::get('barangays', [BarangayController::class, 'index'])->name('barangay.index');
    Route::get('barangays/{barangay}', [BarangayController::class, 'show'])->name('barangay.show');
});
