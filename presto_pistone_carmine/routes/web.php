<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,'homepage'])->name('homepage');


// Rotte Article
Route::get('/create', [ArticleController::class, 'create'])->name('create.article')->middleware('auth');
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/show/{article}', [ArticleController::class, 'show'])->name('article.show');


// Rotte Category
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');
