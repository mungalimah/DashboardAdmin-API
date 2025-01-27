<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KategoriController;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\Route;

//route login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'process']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/reset', [AuthController::class, 'reset']);

// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//route barang
Route::resource('/produk', ProdukController::class)->middleware('auth');
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');


//route Pelanggan
Route::resource('/akun', PelangganController::class)->middleware('auth');

Route::resource('/kategori', KategoriController::class)->middleware('auth');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::get('/kategori/search', [ProdukController::class, 'search'])->name('kategori.search');

Route::get('/pendapatan', function () {
    return view('pendapatan.pendapatan');
});

Route::get('/pesanan', function () {
    return view('pesanan.pesanan');
});

Route::get('/showPelanggan', function () {
    return view('customer.showPelanggan');
});

/*
Route::get('/kategori', function () {
    return view('kategori.kategori');
});


Route::get('/', function () {
    return view('dashboard.dashboard');
});

Route::get('/produk', function () {
    return view('produk.produk');
});

Route::get('/add', function () {
    return view('produk.add');
});

Route::get('/edit', function () {
    return view('produk.edit');
});

Route::get('/delete', function () {
    return view('produk.produk');
});

Route::get('/view', function () {
    return view('produk.view');
});



Route::get('/akun', function () {
    return view('customer.akunPelanggan');
});


Route::get('/hapus', function () {
    return view('pesanan.pesanan');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    return view('auth.login');
});

Route::get('/reset', function () {
    return view('auth.resetPW');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/remove', function () {
    return view('customer.akunPelanggan');
});
*/