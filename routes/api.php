<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

// Books
Route::get('books', function() {
    return ['success' => true];
});
Route::get('books/{id}', [BookController::class, 'show']);
Route::post('books', [BookController::class, 'store']);
Route::get('books/search', [BookController::class, 'search']);

// Statistics
Route::get('statistics/expensive-books', [StatisticsController::class, 'getExpensiveBooks']);
Route::get('statistics/popular-categories', [StatisticsController::class, 'getPopularCategories']);
Route::get('statistics/top-fantasy-and-sci-fi', [StatisticsController::class, 'getTopFantasyAndSciFi']);