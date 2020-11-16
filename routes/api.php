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
Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('regions', 'RegionController@index')->name('region.index');
    Route::get('regions/{region}', 'RegionController@show')->name('region.show');

    Route::get('provinces', 'ProvinceController@index')->name('province.index');
    Route::get('provinces/{province}', 'ProvinceController@show')->name('province.show');

    Route::get('districts', 'DistrictController@index')->name('district.index');
    Route::get('districts/{district}', 'DistrictController@show')->name('district.show');

    Route::get('cities', 'CityController@index')->name('city.index');
    Route::get('cities/{city}', 'CityController@show')->name('city.show');

    Route::get('municipalities', 'MunicipalityController@index')->name('municipality.index');
    Route::get('municipalities/{municipality}', 'MunicipalityController@show')->name('municipality.show');

    Route::get('sub-municipalities', 'SubMunicipalityController@index')->name('sub-municipality.index');
    Route::get('sub-municipalities/{subMunicipality}', 'SubMunicipalityController@show')->name('sub-municipality.show');

    Route::get('barangays', 'BarangayController@index')->name('barangay.index');
    Route::get('barangays/{barangay}', 'BarangayController@show')->name('barangay.show');
});
