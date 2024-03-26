<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/admin/reg', [PageController::class, 'show_adminreg_page'])->name('show_adminreg_page');
Route::post('/admin/reg',[UserController::class, 'AuthAdmin'])->name('AuthAdmin');

Route::group(['middleware' => ['isadmin']], function(){
    // Admin
    Route::get('/admin', [PageController::class, 'show_admin_page'])->name('show_admin_page');
    Route::get('/admin/categories', [PageController::class, 'show_categories_page'])->name('show_categories_page');
    Route::get('/admin/words', [PageController::class, 'show_words_page'])->name('show_words_page');

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
});

