<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CategoryController::class,'index'])->name('category.index');
Route::resource('category', CategoryController::class)->except('index');
