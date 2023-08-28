<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [UserController::class, 'getUser']);

    Route::post('authors/check-slug', [AuthorController::class, 'checkSlug']);
    Route::apiResource('authors', AuthorController::class);

    Route::get('genres/check-slug', [GenreController::class, 'checkSlug']);
    Route::get('genres/all-genres', [GenreController::class, 'getAllGenres']);
    Route::delete('genres/bulk-delete', [GenreController::class, 'bulkDelete']);
    Route::apiResource('genres', GenreController::class);

    Route::get('books/check-slug', [BookController::class, 'checkSlug']);
    Route::apiResource('books', BookController::class);
});
