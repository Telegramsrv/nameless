<?php

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
use Illuminate\Database\Eloquent\Model;

Route::get('wellcome', function () {
    return view('pag/wellcome');
});

Route::get('/',  function () {
    return view('pag/hello');
});

Route::get('bot' , 'Requests@bot')->middleware('VerifyBot');
Route::post('bot' , 'Requests@bot');
Route::get('e' , 'Requests@prova');
Route::get('setup' , 'Home@setup');
Route::get('input' , 'Home@input');
Route::get('broadcast' , 'Home@broadcast_message');
Route::get('callback' , 'Home@callback');