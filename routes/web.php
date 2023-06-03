<?php

use Illuminate\Support\Facades\Route;

// Backsite
use App\Http\Controllers\backsite\Dashboard;
use App\Http\Controllers\backsite\PostController;

// User Manegement
use App\Http\Controllers\UserManegement\RoleController;
use App\Http\Controllers\UserManegement\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




// Authenticate
Route::get('/auth/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/auth/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Frontsite
Route::get('/', [App\http\Controllers\frontsite\HomeController::class, 'index'])->name('home.index');




// CMS
Route::prefix('webapp')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // Role
    Route::get('/role/select', [RoleController::class, 'select'])->name('roles.select');
    Route::resource('role', RoleController::class);
    // Users
    Route::resource('users', UserController::class);


    // Data Penduduk
    Route::resource('datapenduduk', \App\Http\Controllers\backsite\DataPendudukController::class);
   
    // Detail Data Penduduk    
    Route::get('/detaildatapenduduk/{id}', [\App\Http\Controllers\backsite\DetailDataPendudukController::class, 'index'])->name('detaildatapenduduk.index'); 
    Route::post('/detaildatapenduduk', [\App\Http\Controllers\backsite\DetailDataPendudukController::class, 'store'])->name('detaildatapenduduk.store');
    Route::put('/detaildatapenduduk/{id}', [\App\Http\Controllers\backsite\DetailDataPendudukController::class, 'update'])->name('detaildatapenduduk.update'); 
    Route::delete('/detaildatapenduduk/{id}', [\App\Http\Controllers\backsite\DetailDataPendudukController::class, 'destroy'])->name('detaildatapenduduk.destroy');


    // RT
    Route::get('/rt', [\App\Http\Controllers\backsite\RTController::class, 'index'])->name('rt.index'); 
    Route::post('/rt', [\App\Http\Controllers\backsite\RTController::class, 'store'])->name('rt.store'); 
    Route::put('/rt/{id}', [\App\Http\Controllers\backsite\RTController::class, 'update'])->name('rt.update'); 
    Route::delete('/rt/{id}', [\App\Http\Controllers\backsite\RTController::class, 'destroy'])->name('rt.destroy');

    // Kelompok Tani
    Route::get('/kelompoktani', [\App\Http\Controllers\backsite\KelompokTaniController::class, 'index'])->name('kelompoktani.index');     
    Route::post('/kelompoktani', [\App\Http\Controllers\backsite\KelompokTaniController::class, 'store'])->name('kelompoktani.store'); 
    Route::put('/kelompoktani/{id}', [\App\Http\Controllers\backsite\KelompokTaniController::class, 'update'])->name('kelompoktani.update'); 
    Route::delete('/kelompoktani/{id}', [\App\Http\Controllers\backsite\KelompokTaniController::class, 'destroy'])->name('kelompoktani.destroy'); 

    // Anggota PokTan
    Route::get('/anggotapoktan/{id}', [\App\Http\Controllers\backsite\AnggotaPokTanController::class, 'index'])->name('anggotapoktan.index');  
    Route::post('/anggotapoktan', [\App\Http\Controllers\backsite\AnggotaPokTanController::class, 'store'])->name('anggotapoktan.store'); 
    Route::put('/anggotapoktan/{id}', [\App\Http\Controllers\backsite\AnggotaPokTanController::class, 'update'])->name('anggotapoktan.update'); 
    Route::delete('/anggotapoktan/{id}', [\App\Http\Controllers\backsite\AnggotaPokTanController::class, 'destroy'])->name('anggotapoktan.destroy');   

    // Sumber Daya
    Route::get('/sumberdaya', [\App\Http\Controllers\backsite\SumberDayaController::class, 'index'])->name('sumberdaya.index');
    Route::post('/sumberdaya', [\App\Http\Controllers\backsite\SumberDayaController::class, 'store'])->name('sumberdaya.store'); 
    Route::put('/sumberdaya/{id}', [\App\Http\Controllers\backsite\SumberDayaController::class, 'update'])->name('sumberdaya.update'); 
    Route::delete('/sumberdaya/{id}', [\App\Http\Controllers\backsite\SumberDayaController::class, 'destroy'])->name('sumberdaya.destroy'); 

    // Detail Sumber Daya
    Route::get('/detailsumberdaya/{id}', [\App\Http\Controllers\backsite\DetailSumberDayaController::class, 'index'])->name('detailsumberdaya.index');  
    Route::post('/detailsumberdaya', [\App\Http\Controllers\backsite\DetailSumberDayaController::class, 'store'])->name('detailsumberdaya.store'); 
    Route::put('/detailsumberdaya/{id}', [\App\Http\Controllers\backsite\DetailSumberDayaController::class, 'update'])->name('detailsumberdaya.update'); 
    Route::delete('/detailsumberdaya/{id}', [\App\Http\Controllers\backsite\DetailSumberDayaController::class, 'destroy'])->name('detailsumberdaya.destroy');  

    //  Hasil Sumber Daya
    Route::get('/hasilsumberdaya', [\App\Http\Controllers\backsite\HasilSumberDayaController::class, 'index'])->name('hasilsumberdaya.index');
    Route::post('/hasilsumberdaya', [\App\Http\Controllers\backsite\HasilSumberDayaController::class, 'store'])->name('hasilsumberdaya.store'); 
    Route::put('/hasilsumberdaya/{id}', [\App\Http\Controllers\backsite\HasilSumberDayaController::class, 'update'])->name('hasilsumberdaya.update'); 
    Route::delete('/hasilsumberdaya/{id}', [\App\Http\Controllers\backsite\HasilSumberDayaController::class, 'destroy'])->name('hasilsumberdaya.destroy'); 

    // Sejarah
    Route::get('/sejarah', [\App\Http\Controllers\backsite\SejarahController::class, 'index'])->name('sejarah.index');
    Route::put('/sejarah/{id}', [\App\Http\Controllers\backsite\SejarahController::class, 'update'])->name('sejarah.update'); 
    
    Route::resource('post', \App\Http\Controllers\backsite\PostController::class);


});

require __DIR__.'/auth.php';
