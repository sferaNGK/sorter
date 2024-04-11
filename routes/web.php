<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameCatController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/admin/reg', [PageController::class, 'show_adminreg_page'])->name('show_adminreg_page');
Route::post('/admin/reg',[UserController::class, 'AuthAdmin'])->name('AuthAdmin');

    // Admin
    Route::get('/admin', [PageController::class, 'show_admin_page'])->name('show_admin_page');
    Route::get('/admin/categories', [PageController::class, 'show_categories_page'])->name('show_categories_page');
    Route::get('/admin/words', [PageController::class, 'show_words_page'])->name('show_words_page');
    Route::get('/admin/games', [PageController::class, 'show_games_page'])->name('show_games_page');
    Route::get('/admin/styles', [PageController::class, 'show_styles_page'])->name('show_styles_page');

    Route::get('/admin/logout',[UserController::class, 'AdminLog'])->name('AdminLog');

    // Categories
    Route::get('/admin/categories/get', [CategoryController::class, 'show'])->name('GetCategories');
    Route::post('/admin/categories/add', [CategoryController::class, 'AddCategory'])->name('AddCategory');
    Route::post('/admin/categories/edit', [CategoryController::class, 'EditCategory'])->name('EditCategory');
    Route::post('/admin/categories/delete', [CategoryController::class, 'DeleteCategory'])->name('DeleteCategory');

    // Words
    Route::get('/admin/words/get', [WordController::class, 'show'])->name('GetWord');
    Route::post('/admin/words/add', [WordController::class, 'AddWord'])->name('AddWord');
    Route::post('/admin/words/edit', [WordController::class, 'EditWord'])->name('EditWord');
    Route::post('/admin/words/delete', [WordController::class, 'DeleteWord'])->name('DeleteWord');

    // Games
    Route::get('/admin/game/get', [GameController::class, 'show'])->name('GetGames');
    Route::post('/admin/game/add', [GameController::class, 'AddGame'])->name('AddGame');
    Route::post('/admin/game/edit', [GameController::class, 'EditGame'])->name('EditGame');
    Route::post('/admin/game/delete', [GameController::class, 'DeleteGame'])->name('DeleteGame');

    // Styles
    Route::get('/admin/style/get', [StyleController::class, 'show'])->name('GetStyle');
    Route::post('/admin/style/add', [StyleController::class, 'AddStyle'])->name('AddStyle');
    Route::post('/admin/style/edit', [StyleController::class, 'EditStyle'])->name('EditStyle');
    Route::post('/admin/style/delete', [StyleController::class, 'DeleteStyle'])->name('DeleteStyle');

// GameCat
Route::get('/gameCat/get', [GameCatController::class, 'show'])->name('getGameCat');

Route::get('/games/get', [GameController::class, 'show'])->name('getGames');
Route::post('/showGame', [PageController::class, 'show_game_page'])->name('show_game_page');
Route::get('/showGame/game/{game}', [PageController::class, 'show_game'])->name('show_game');


Route::get('/game/categories/get',[CategoryController::class, 'gameCategoryGet'])->name('gameCategoryGet');
Route::post('/game/check', [WordController::class, 'checkGame'])->name('checkGame');
