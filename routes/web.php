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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // news
    Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
    Route::get('news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
    Route::get('/news/{news}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{news}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
    Route::put('/news/update/{news}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/delete/{news}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');

    // category types
    Route::resource('department-types', App\Http\Controllers\DepartmentTypeController::class);

    // profile
    Route::view('/profile', 'profile.show')->name('profile.show');
    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');



    Route::get('/events', function () {
        return view('events.index');
    })->name('events.index');

});
