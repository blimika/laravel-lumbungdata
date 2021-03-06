<?php

use Illuminate\Http\Request;
use App\DataTmpl1;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('ragam:api')->group(function(){
    Route::get('/indikator/terakhir', 'IndikatorAPIController@indikatorTerakhir');
    Route::get('/indikator/subjek/{idSubjek}','IndikatorAPIController@tampilkanBySubjek');
    Route::get('/indikator/{idIndikator}', 'IndikatorAPIController@tampilkan');
    Route::get('/cari', 'IndikatorAPIController@cari');
    Route::get('/subjek/semua', 'IndikatorAPIController@semuaSubjek');
    Route::get('/metadata/{idMetadata}', 'IndikatorAPIController@lihatMetadata');
 });

Route::get('getDataApi', function() {
    $data = DataTmpl1::all();

    return response()->json(['data'=>$data], 200);
});
