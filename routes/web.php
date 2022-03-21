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
        Route::delete('/accounts/delete/{id}','AccountController@deleteAcc')-> middleware('can:admin');

        Route::get('/allow-lists','Allow_listController@index');
        Route::post('/allow-lists/addNew','Allow_listController@addNewAL');
        Route::patch('/allow-lists/edit/{id}','Allow_listController@editAL');
        Route::delete('/allow-lists/{id}/delete','Allow_listController@delete');

        Route::get('/devices','DeviceController@index');
        Route::post('/devices/addNew','DeviceController@addNewDev');
        Route::patch('/devices/edit/{id}','DeviceController@editDev');
        Route::delete('/devices/{id}/delete','DeviceController@delete');
        Route::patch('/devices/editmany','DeviceController@editManyDev');
    });

    Route::get('/sms-lists','Sms_listController@index');
    Route::delete('/sms-lists/{id}/delete','Sms_listController@delete')-> middleware('can:common');
    //Route::post('/sms-lists/{id}','Sms_listController@newSMSIn');

    Route::post('/get-notification','NavController@getNoti');
    Route::post('/read-notification','NavController@readOne');
    Route::post('/read-all-notification','NavController@readAll');

    Route::view('/docmenu','docmenu');


});


