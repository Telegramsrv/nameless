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


//Route::get('bot' , 'Requests@bot')->middleware('VerifyBot');
Route::get('bot' , 'Requests@bot');
Route::post('bot' , 'Requests@bot');
Route::get('broadcast' , function (){
    return view('pag/broadcast');
});
Route::get('broadcast/{id}', 'Requests@broadcast');
