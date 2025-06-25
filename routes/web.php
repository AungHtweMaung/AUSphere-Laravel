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
        Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.admin-index');
        Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
        Route::middleware(['admin_auth'])->group(function () {

            Route::get('news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
            Route::get('/news/{news}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
            Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
            Route::put('/news/update/{news}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
            Route::delete('/news/delete/{news}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
        });

        // events
        Route::resource('/events', App\Http\Controllers\EventController::class);


        // department types
        Route::resource('/department-types', App\Http\Controllers\DepartmentTypeController::class);

        // department
        Route::resource('/departments', App\Http\Controllers\DepartmentController::class);

        // profile
        Route::view('/profile', 'profile.show')->name('profile.show');
        Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    // });

    // Route::prefix('user')->group(function () {

    // });

});
