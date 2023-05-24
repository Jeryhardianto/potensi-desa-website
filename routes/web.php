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



    Route::resource('post', \App\Http\Controllers\backsite\PostController::class);


});

require __DIR__.'/auth.php';
