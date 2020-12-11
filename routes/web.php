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

use Illuminate\Support\Facades\Route;
use \App\Bank;

Route::get('/', function () {
    return view('statPage');
});

Route::group(['prefix' => '/contact'], function(){
    Route::get('/', 'ContactController@index')->name('contact_list');
    Route::get('/add', 'ContactController@create')->name('add_contact');
    Route::get('/{id}', 'ContactController@show')->name('view_contact');
    Route::get('/edit/{id}', 'ContactController@edit')->name('edit_contact');
    Route::post('/', 'ContactController@store');
    Route::put('/{id}', 'ContactController@update');
    Route::delete('/{id}', 'ContactController@destroy');
});

//Route::get('pay', 'PayOrderController@store');

Route::get('pay', function () {
    Bank::payment('driss', 'walid', '500');
});