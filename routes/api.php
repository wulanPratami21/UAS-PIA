<?php

use App\Http\Controllers\Api\ProfilsController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\UsahasController;
use App\Http\Controllers\Api\HistorysController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('', [ProfilsController::class, 'index']);

Route::resources([
    'profils' => ProfilsController::class,
    'homes' => HomeController::class,
    'usahas' => UsahasController::class,
    'contacts' => ContactsController::class,
    'historys' => HistorysController::class,
]);