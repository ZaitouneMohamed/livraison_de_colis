<?php

use App\Http\Controllers\admin\adminHomeController;
use App\Http\Controllers\livreur\livreurhomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\employeeController;
use App\Http\Controllers\user\colisCrudController;
use App\Http\Controllers\user\userpanelController;

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

Route::prefix('is-admin')->group(function(){
    Route::get('/', [userpanelController::class, 'index'])->name('userpanel.home'); // user home
    Route::resource('employees', employeeController::class); // employee home
    Route::resource('colis', colisCrudController::class); // (CRUD) colis
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// for user
Route::middleware(['auth:sanctum', 'verified','user'])->prefix('is-admin')->group(function () {
    Route::get('/', [userpanelController::class, 'index'])->name('userpanel.home'); // user home
    Route::resource('employees', employeeController::class); // employee home
    Route::resource('colis', colisCrudController::class); // (CRUD) colis
    Route::get('/colis_a_traiter', [userpanelController::class, 'traiter_colis'])->name('user.colis.traiter'); // user colis a traiter
    Route::get('/view_coli/{colis_id}', [userpanelController::class, 'view_coli'])->name('user.coli.view');
});

// for admin
Route::middleware(['auth:sanctum', 'verified','admin'])->prefix('admin')->group(function () {
    Route::get('/', [adminHomeController::class, 'index'])->name("admin.home");
    Route::get('/colis_list', [adminHomeController::class, 'colis'])->name("admin.colis");
    Route::get('/coli/{id}', [adminHomeController::class, 'view_colis'])->name("admin.view.coli");
    Route::get('/valide_coli', [adminHomeController::class, 'valider_coli'])->name("admin.valider.coli");
    Route::get('/refuse_coli/{id}', [adminHomeController::class, 'refuse_coli'])->name("admin.refuse.coli");
});

// for livreur
Route::middleware(['auth:sanctum', 'verified','livreur'])->prefix('livreur')->group(function () {
    Route::get('/', [livreurhomeController::class, 'index'])->name("livreur.home");
    Route::get('/colis', [livreurhomeController::class, 'colis_list'])->name("livreur.colis_list");
    Route::get('/request', [livreurhomeController::class, 'colis_request'])->name('livreur.request');
    Route::get('/accepte_order', [livreurhomeController::class, 'accepte_colis'])->name('livreur.accepte.order');
    Route::get('/refude_order', [livreurhomeController::class, 'refuse_colis'])->name('livreur.refuse.order');
    Route::get('/my_colis', [livreurhomeController::class, 'my_colis'])->name("livreur.colis");
    Route::get('/order/{id}', [livreurhomeController::class, 'view_order'])->name("livreur.view.coli");
    Route::post('/modify_place', [livreurhomeController::class, 'place_now'])->name("livreur.place.now");
});
