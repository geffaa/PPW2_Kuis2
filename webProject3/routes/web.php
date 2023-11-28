<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GalleryController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/dashboard', [BukuController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::post('/add-book/{buku}', [BukuController::class, 'addbook'])->name('addfav.book');
    Route::get('/favbooks', [BukuController::class, 'indexFavBooks'])->name('favbooks');;
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::get('/buku', [BukuController::class, 'index'])->name('buku');;
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');


Route::get('/detail-buku/{title}',  [BukuController::class, 'galbuku'])->name('galeri.buku');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/create', [BukuController::class, 'store'])->name('buku.store');
    Route::delete('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::get('/gallery/delete/{id}', [GalleryController::class, 'delGallery'])->name('gallery.delete');

});

require __DIR__.'/auth.php';
