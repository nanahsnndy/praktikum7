<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\PublicProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/experience', function () {
    return view('experience');
})->name('experience');

Route::get('/education', function () {
    return view('education');
})->name('education');

// Halaman detail project publik
Route::get('/projects/{slug}', [PublicProjectController::class, 'show'])
    ->name('projects.public.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');

    Route::get('/posts/trash', [PostController::class, 'trash'])
        ->name('posts.trash');

    Route::get('/post/profile-saya', function () {
        return view('profile-saya');
    })->middleware('admin')->name('post.profile-saya');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::prefix('post')->name('post.')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('projects', ProjectController::class);

        Route::post('/projects/{project}/gallery', [ProjectGalleryController::class, 'store'])
            ->name('projects.gallery.store');

        Route::put('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'update'])
            ->name('projects.gallery.update');

        Route::delete('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'destroy'])
            ->name('projects.gallery.destroy');
    });
});

require __DIR__ . '/auth.php';