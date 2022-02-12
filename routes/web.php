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
|
*/


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/','AccountController@logincheck');

    Route::get('/accounts','AccountController@index');
    Route::get('/logincheck','AccountController@logincheck');

    Route::post('/accounts/addNew','AccountController@addNewAcc');
    Route::post('/accounts/edit/{id}','AccountController@editAcc');
    Route::post('/accounts/delete/{id}','AccountController@deleteAcc');

    Route::get('/allow-lists','Allow_listController@index');
    Route::post('/allow-lists/addNew','Allow_listController@addNewAL');
    Route::post('/allow-lists/edit/{id}','Allow_listController@editAL');
    Route::post('/allow-lists/{id}/delete','Allow_listController@delete');

    Route::get('/devices','DeviceController@index');
    Route::post('/devices/addNew','DeviceController@addNewDev');
    Route::post('/devices/edit/{id}','DeviceController@editDev');
    Route::post('/devices/{id}/delete','DeviceController@delete');
    Route::post('/devices/editmany','DeviceController@editManyDev');

    Route::get('/sms-lists','Sms_listController@index');

    Route::get('/newapitest', function () {
        return view('new_api_test');
    });
    Route::post('/sms-lists/{id}','Sms_listController@newSMSIn');
    Route::post('/sms-lists/{id}/delete','Sms_listController@delete');

    Route::post('/read-notification','NavController@readOne');
    Route::post('/read-all-notification','NavController@readAll');
});


