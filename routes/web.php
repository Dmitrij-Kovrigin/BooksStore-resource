<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OutfitController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
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

// Rodo tuscia naujos knygos forma
Route::get('/books/create', [BookController::class, 'create'])->name('book_create');
Route::post('/books/store', [BookController::class, 'store'])->name('book_store');

//Nauja outfito forma
Route::get('/outfits/create', [OutfitController::class, 'create'])->name('outfit_create');
Route::post('/outfits/store', [OutfitController::class, 'store'])->name('outfit_store');
//Rodo knygu sarasa
Route::get('/books', [BookController::class, 'index'])->name('book_index');
//Rodo rubu sarasa
Route::get('/outfits', [OutfitController::class, 'index'])->name('outfit_index');
// Rodo uzpildyta forma, paruosta redagavimui
Route::get('/books/edit/{book}', [BookController::class, 'edit'])->name('book_edit');
//Uzsaugo redaguota knyga i db
Route::put('/books/update/{book}', [BookController::class, 'update'])->name('book_update');
Route::get('/outfits/edit/{outfit}', [OutfitController::class, 'edit'])->name('outfit_edit');
//Uzsaugo redaguota knyga i db
Route::put('/outfits/update/{outfit}', [OutfitController::class, 'update'])->name('outfit_update');
//Tria knyga db-eje
Route::delete('/books/delete/{book}', [BookController::class, 'destroy'])->name('book_delete');
// knygos informacija
Route::get('/books/show/{book}', [BookController::class, 'show'])->name('book_show');
//Trina outfita db-eje
Route::delete('/outfits/delete/{outfit}', [OutfitController::class, 'destroy'])->name('outfit_delete');
// outfito informacija
Route::get('/outfits/show/{outfit}', [OutfitController::class, 'show'])->name('outfit_show');
// Generate PDF
Route::get('/books/pdf/{book}', [BookController::class, 'pdf'])->name('book_pdf');




Route::prefix('authors')->name('author_')->group(function () {
    Route::get('/create', [AuthorController::class, 'create'])->name('create');
    Route::post('/store', [AuthorController::class, 'store'])->name('store');
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/edit/{author}', [AuthorController::class, 'edit'])->name('edit');
    Route::put('/update/{author}', [AuthorController::class, 'update'])->name('update');
    Route::delete('/delete/{author}', [AuthorController::class, 'destroy'])->name('delete');
    Route::get('/show/{author}', [AuthorController::class, 'show'])->name('show');
});

Route::prefix('brands')->name('brand_')->group(function () {
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [BrandController::class, 'store'])->name('store');
    Route::get('/', [BrandController::class, 'index'])->name('index');
    Route::get('/edit/{brand}', [BrandController::class, 'edit'])->name('edit');
    Route::put('/update/{brand}', [BrandController::class, 'update'])->name('update');
    Route::delete('/delete/{brand}', [BrandController::class, 'destroy'])->name('delete');
    Route::get('/show/{brand}', [BrandController::class, 'show'])->name('show');
});



Route::get('/outfits/create', [OutfitController::class, 'create'])->name('outfit_create');
Route::post('/outfits/store', [OutfitController::class, 'store'])->name('outfit_store');
Route::get('/outfits', [OutfitController::class, 'index'])->name('outfit_index');
Route::get('/outfits/edit/{outfit}', [OutfitController::class, 'edit'])->name('outfit_edit');
Route::put('/outfits/update/{outfit}', [OutfitController::class, 'update'])->name('outfit_update');
Route::delete('/outfits/delete/{outfit}', [OutfitController::class, 'destroy'])->name('outfit_delete');
Route::get('/outfits/show/{outfit}', [OutfitController::class, 'show'])->name('outfit_show');
Route::get('/outfits/pdf/{outfit}', [OutfitController::class, 'pdf'])->name('outfit_pdf');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/show-author/{id}', [TestController::class, 'showAuthorName'])->name('show_authors_name');

Route::prefix('tags')->name('tag_')->group(function () {
    Route::get('/create', [TagController::class, 'create'])->name('create');
    Route::post('/store', [TagController::class, 'store'])->name('store');
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/edit/{tag}', [TagController::class, 'edit'])->name('edit');
    Route::put('/update/{tag}', [TagController::class, 'update'])->name('update');
    Route::delete('/delete/{tag}', [TagController::class, 'destroy'])->name('delete');
});
