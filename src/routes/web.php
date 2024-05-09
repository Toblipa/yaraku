<?php

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

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->action([BooksController::class, 'index']);
});

Route::get('/books', [BooksController::class, 'index'])->name('books.index');
Route::post('/books/add', [BooksController::class, 'store'])->name('books.add');
Route::delete('/books/delete/{book}', [BooksController::class, 'destroy'])->name('books.delete');
Route::put('/books/edit/{book}', [BooksController::class, 'update'])->name('books.edit');
