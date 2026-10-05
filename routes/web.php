<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');

Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');