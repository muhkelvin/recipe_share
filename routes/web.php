<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeCollectionController;
use App\Http\Controllers\RecipeCommentController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeRatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth:web', 'verified'])->group(function () {
    // Recipe Routes
    Route::resource('recipes', RecipeController::class);
    Route::post('recipe_saved',[RecipeController::class,'addToCollection'])->name('recipe_saved');

    // Recipe Rating Routes
    Route::post('recipes/{recipe}/ratings', [RecipeRatingController::class, 'store'])->name('recipe_ratings.store');

    // Recipe Comment Routes
    Route::post('recipes/{recipe}/comments', [RecipeCommentController::class, 'store'])->name('recipe_comments.store');

    // Recipe Collection Routes
    Route::resource('collections', RecipeCollectionController::class);
});
