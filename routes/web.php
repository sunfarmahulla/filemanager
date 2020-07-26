<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'AuthController@login')->name('login');
Route::post('/dir','FileManagerController@directory')->name('dir');
Route::get('/file-manager', 'FileManagerController@getDir');
Route::post('/dir-rename','FileManagerController@rename');
Route::get('/dir-delete/{folder}', 'FileManagerController@deleteFolder');
Route::get('/dir/{folder}', 'FileManagerController@goToFolder');
Route::post('/upload-file/{folder}','FileManagerController@upload');
Route::post('/rename-file', 'FileManagerController@renameFile');
Route::get('/file-delete/{id}','FileManagerController@deleteFile');
Route::get('/file-download/{id}','FileManagerController@downloadFile');