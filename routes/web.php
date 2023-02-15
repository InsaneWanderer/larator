<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', )->name('adverts.index');
// Route::post('/', [AdvertController::class, 'index']);
Route::match(['GET', 'POST'], "/", [AdvertController::class, 'index'])->name('adverts.index');
// Route::post('/filtrate', [AdvertController::class, 'filtindex'])->name('adverts.index.post');

Route::get('/login', [AuthController::class, 'logForm'])->name('login');
Route::post('/login',[AuthController::class, 'auth']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registrate', [AuthController::class, 'regForm'])->name('registrate');
Route::post('/registrate',[AuthController::class, 'registrate']);
// Route::get('/registrate')->name('registrate');
// Route::post('/registrate', "AuthController@registrate");

Route::get('/addverts/create', [AdvertController::class, "createForm"])->name('adverts.create');
Route::post('/addverts/create',  [AdvertController::class, "create"]);

// Route::get('/addverts/{addvert}', "AdvertController@show")->name('adverts.show');