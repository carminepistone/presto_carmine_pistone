<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,'homepage'])->name('homepage');


// Rotte Article
Route::get('/create/article', [ArticleController::class, 'create'])->name('create.article')->middleware('auth');
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/show/{article}', [ArticleController::class, 'show'])->name('article.show');


// Rotte Category
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');

// Rotte Revisori
Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');
Route::get('revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

// Rotte Ricerca
Route::get('search/article', [PublicController::class, 'searchArticles'])->name('article.search');


// Rotta cambio lingua
Route::post('/lingua/{lang}', [PublicController::class,'setLanguage'])->name('setLocale');