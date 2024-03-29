<?php

use App\Http\Controllers\ScraperController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addis-it', [ScraperController::class, 'scrapeIt']);

Route::get('/test-it', [ScraperController::class, 'testScrap']);

Route::get('/view-data', [ScraperController::class, 'viewData']);
