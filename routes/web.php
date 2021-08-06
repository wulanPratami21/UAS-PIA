<?php

use Illuminate\Support\Facades\Route;
use App\Models\historys;
use App\Models\Homes;
use App\Models\contacts;
use App\Models\profils;
use App\Models\usahas;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilsController;
use App\Http\Controllers\UsahasController;
use App\Http\Controllers\HistorysController;
use App\Http\Controllers\ContactsController;

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

Route::get('', [ProfilsController::class, 'index']);
//Route::get('/profils', [ProfilsController::class, 'index']);
//Route::get('/profils/create', [ProfilsController::class, 'create']);
//Route::POST('/profils', [ProfilsController::class, 'store']);
//Route::get('/profils/{id}', [ProfilsController::class, 'show']);
//Route::get('/profils/{id}/edit', [ProfilsController::class, 'edit']);
//Route::put('/profils/{id}', [ProfilsController::class, 'update']);
//Route::delete('/profils/{id}', [ProfilsController::class, 'destory']);

Route::resources([
    'profils' => ProfilsController::class,
    'homes' => HomeController::class,
    'usahas' => UsahasController::class,
    'contacts' => ContactsController::class,
    'historys' => HistorysController::class,
]);

