<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//creo la route per l'index della mia API dove visualizzo tutti i progetti con tutti i type e le technologies associate
Route::get('/projects', [PageController::class, 'index']);
// creo la route per visualizzare tutte le technologies
Route::get('/technologies', [PageController::class, 'technologies']);
// creo la route per visualizzare tutti i type
Route::get('/types', [PageController::class, 'types']);

// rotta per gestire il singolo progetto passandogli lo slug
Route::get('/project-slug/{slug}', [PageController::class, 'projectSlug']);
