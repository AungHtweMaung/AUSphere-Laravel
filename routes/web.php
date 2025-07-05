<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');


    // Route::prefix('admin')->group(function () {
        // news
        Route::middleware(['admin_auth'])->group(function () {
            Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
            Route::get('/news/{news}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
            Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
            Route::put('/news/update/{news}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
            Route::delete('/news/delete/{news}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
        });
        Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

        // events
        Route::resource('/events', App\Http\Controllers\EventController::class);


        // department types
        Route::resource('/department-types', App\Http\Controllers\DepartmentTypeController::class);

        // department
        Route::resource('/departments', App\Http\Controllers\DepartmentController::class);

        // profiles
        Route::get('/profiles/{profile}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
        Route::put('/profiles/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');


        // social posts
        Route::get('/users/{user}/social-posts', [App\Http\Controllers\SocialPostController::class, 'index'])->name('social-posts.index');
        Route::get('/users/{user}/social-posts/create', [App\Http\Controllers\SocialPostController::class, 'create'])->name('social-posts.create');
        Route::post('/users/{user}/social-posts', [App\Http\Controllers\SocialPostController::class, 'store'])->name('social-posts.store');
        Route::delete('/users/{user}/social-posts/{post}', [App\Http\Controllers\SocialPostController::class, 'destroy'])->name('social-posts.destroy');


        // profile
        // Route::view('/campus-information', 'campus-information.show')->name('campus-information.show');
        // Route::view('/campus-information/edit', 'campus-information.edit')->name('campus-information.edit');
    // });

    // Route::prefix('user')->group(function () {

    // });

});
