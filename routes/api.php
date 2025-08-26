<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('books/search', [BookController::class, 'search']);
Route::apiResource('books', BookController::class);
