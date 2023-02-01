<?php

use App\Http\Controllers\AdvertController;
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

Route::get('/{data?}', [AdvertController::class, 'index'])->name('adverts.index');
Route::post('/filtrate', [AdvertController::class, 'filtindex'])->name('adverts.index.post');

Route::get('/login')->name('login');
Route::post('/login', "AuthController@auth");

Route::post('/logout', "AuthController@logout")->name('logout');

Route::get('/registrate')->name('registrate');
Route::post('/registrate', "AuthController@registrate");

Route::get('/addverts/create')->name('adverts.create');
Route::post('/addverts/create', "AdvertController@create");

Route::get('/addverts/{addvert}', "AdvertController@show")->name('adverts.show');