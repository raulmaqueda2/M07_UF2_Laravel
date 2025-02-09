<?php

use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('year')->group(function () {
    Route::group(['prefix' => 'filmout'], function () {
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}', [FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('filmsByYear/{filmsByYear?}', [FilmController::class, "listFilmsByYear"])->name('listFilmsByYear');
        Route::get('filmsByGenre/{filmsByGenre?}', [FilmController::class, "listFilmsByGenre"])->name('listFilmsByGenre');
        Route::get('sortFilms', [FilmController::class, "sortFilms"])->name('sortFilms');
        Route::get('countFilms', [FilmController::class, "countFilms"])->name('countFilms');
        Route::get('films', [FilmController::class, "listFilms"])->name('listFilms');
    });
});
Route::group(['prefix' => 'filmin'], function () {
    Route::post('createFilm', [FilmController::class, "createFilm"])->name('createFilm');
    Route::get('updateFilm/{id}', [FilmController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [FilmController::class, "update"])->name('update');
    Route::get('deleteFilm/{id}', [FilmController::class, 'deleteFilm'])->name('films.delete');
});

Route::group(['prefix' => 'error'], function () {
    Route::get('url', function () {
        return view('error', ["error" => "url no valida"]);
    });
    Route::get('filmExist', function () {
        return view('error', ["error" => "el nombre de la pelicula ya existe"]);
    });
    Route::get('film', function () {
        return view('error', ["error" => "pelicula no encontrada"]);
    });
});

Route::group(['prefix' => 'success'], function () {
    Route::get('move', function () {
        return view('success', ["success" => "Pelicula actualizada"]);
    });
    Route::get('filmExist', function () {
        return view('error', ["error" => "el nombre de la pelicula ya existe"]);
    });
});
