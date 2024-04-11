<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/games',function(){
    $game = Game::all();
    return response()->json($game);
});
Route::get('/game/{id}',[PageController::class, 'game_page_show']);
Route::get('/gamed/{id}',[PageController::class, 'game_page_show1']);
Route::post('/categories',[CategoryController::class, 'gameCategories']);
