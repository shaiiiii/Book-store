<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookIssuanceController;
// Public API Routes
// Protected API Routes
require base_path('routes/auth.php');

Route::middleware(['auth:sanctum'])->group(function () {
    //---------------Handle Books------------------
    Route::prefix('admin/books')->group(function () {
        Route::get('/', [BookController::class, 'Home'])->name('api.admin.books.home');
        Route::post('/store', [BookController::class, 'store'])->name('api.admin.books.store');
      Route::get('/{id}', [BookController::class, 'edit'])->name('api.admin.book.get');

        Route::put('/{id}', [BookController::class, 'update'])->name('api.admin.books.update');
        Route::delete('/{id}', [BookController::class, 'delete'])->name('api.admin.books.delete');
    });

    //---------------Handle Book Issuances------------------
    Route::prefix('admin/book-issuances')->group(function () {
        Route::get('/{userId}', [BookIssuanceController::class, 'index'])->name('api.book-issuances.index');
        Route::post('/', [BookIssuanceController::class, 'store'])->name('api.book-issuances.store');
        Route::put('/{issuance}/receive', [BookIssuanceController::class, 'receive'])->name('api.book-issuances.receive');
        Route::get('/user/{userId}', [BookIssuanceController::class, 'getByUser']);

    });

    Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
});
Route::get('/user', function (Request $request) {
    return $request->user();
});
