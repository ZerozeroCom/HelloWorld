<?php

use App\DataTables\DevicesDataTable;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  刪除功能controller還會檢查一次
*/


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/','Sms_listController@index');

    Route::middleware(['can:common'])->group(function(){
        Route::get('/accounts','AccountController@index');
        Route::post('/accounts/addNew','AccountController@addNewAcc');
        Route::patch('/accounts/edit/{id}','AccountController@editAcc');
        Route::delete('/accounts/delete/{id}','AccountController@deleteAcc')->middleware('can:admin');

        Route::get('/allow-lists','Allow_listController@index');
        Route::post('/allow-lists/addNew','Allow_listController@addNewAL');
        Route::patch('/allow-lists/edit/{id}','Allow_listController@editAL');
        Route::delete('/allow-lists/{id}/delete','Allow_listController@delete');

        Route::get('/devices','DeviceController@index');
        Route::post('/devices/addNew','DeviceController@addNewDev');
        Route::post('/devices/editkeyword','DeviceController@editKeyword');
        Route::patch('/devices/edit/{id}','DeviceController@editDev');
        Route::delete('/devices/{id}/delete','DeviceController@delete');
        Route::patch('/devices/editmany','DeviceController@editManyDev');
    });

    Route::get('/sms-lists','Sms_listController@index');
    Route::view('/sms-lists2','sms_list2');
    Route::post('/sms-lists2','Sms_listController@index2');
    Route::post('/sms-lists3','Sms_listController@index3');
    Route::delete('/sms-lists/{id}/delete','Sms_listController@delete')->middleware('can:common');
    Route::delete('/sms-lists/deleteMany','Sms_listController@deleteMany')->middleware('can:common');
    //Route::post('/sms-lists/{id}','Sms_listController@newSMSIn');

    Route::post('/get-notification','NavController@getNoti');
    Route::post('/read-notification','NavController@readOne');
    Route::post('/read-all-notification','NavController@readAll');

    Route::view('/docmenu','docmenu');
    Route::view('/app-download','appdownload');


    Route::get('/sms-log/33456', 'APIController@uploadLog')->middleware('can:admin');
    Route::get('/sms-log/33456/all-download', 'APIController@allLogDownload')->middleware('can:admin');
    Route::get('/sms-log/33456/all-delete', 'APIController@allLogDelete')->middleware('can:admin');

    Route::view('/app-upload/22568','appupload')->middleware('can:admin');
    Route::post('/app-upload/22568/uploadapp/{id}', 'NavController@uploadApp')->middleware('can:admin');
});
    Route::get('/app-download/apk','NavController@getDownload');
    Route::get('/app-download/mp4','NavController@getDownloadmp4');
    Route::view('/doc/xiaomi','xiaomi');
    Route::view('/doc/oppo','oppo');

