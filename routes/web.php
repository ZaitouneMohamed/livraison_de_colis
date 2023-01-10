<?php

use App\Http\Controllers\admin\adminHomeController;
use App\Http\Controllers\admin\manageAdminController;
use App\Http\Controllers\admin\manageLivreurController;
use App\Http\Controllers\livreur\livreurhomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\employeeController;
use App\Http\Controllers\user\colisCrudController;
use App\Http\Controllers\user\userpanelController;


Route::get('/', function () {
    return view('welcome');
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
    Route::get('colis_a_traiter', [userpanelController::class, 'traiter_colis'])->name('user.colis.traiter'); // user colis a traiter
    Route::get('colis_livree', [userpanelController::class, 'colis_livree'])->name('user.colis.livree'); // user colis livree
    Route::get('view_coli/{colis_id}', [userpanelController::class, 'view_coli'])->name('user.coli.view');
    Route::post('bon_liv_pdf/{id}', [userpanelController::class, 'bon_livraison_pdf'])->name("user.bon.livraison.pdf"); // export pdf
    Route::get('returned_colis', [userpanelController::class, 'returned_colis'])->name('user.coli.returned'); // user les colis returné
    Route::get('ramassage', [userpanelController::class, 'ramassage'])->name('user.coli.ramassage');
    Route::get('coli_in_bon/{id}', [userpanelController::class, 'colis_in_bon'])->name('user.coli.in.bon');
    Route::get('create_bon_ramassage/{id}', [userpanelController::class, 'colis_for_ramassage'])->name('user.colis.add.bon.ramasser');
    Route::get('add_bon_livraison', [userpanelController::class, 'add_bon_livraison'])->name('user.coli.add.bon.livraison');
    Route::get('add_colis_to_bon_livraison', [userpanelController::class, 'colis_with_bons'])->name('user.coli.add.coli.to.bon.livraison');
    Route::get('colis_bon/{id}', [userpanelController::class, 'colis_list_bons'])->name('user.coli.view_and_add');
    Route::get('add_coli_to_bon/{id}', [userpanelController::class, 'add_colis_to_bon'])->name('user.add.coli.to.bon');

});

// for admin

Route::middleware(['auth:sanctum', 'verified','admin'])->prefix('admin')->group(function () {
    Route::get('/', [adminHomeController::class, 'index'])->name("admin.home");
    Route::get('/colis_list', [adminHomeController::class, 'colis'])->name("admin.colis");
    Route::get('/coli/{id}', [adminHomeController::class, 'view_coli'])->name("admin.view.coli");
    Route::get('/order/{id}', [adminHomeController::class, 'view_order'])->name("admin.view.order");
    Route::get('/valide_coli', [adminHomeController::class, 'valider_coli'])->name("admin.valider.coli");
    Route::get('/refuse_coli', [adminHomeController::class, 'refuse_coli'])->name("admin.refuse.coli");
    Route::get('/orders_list', [adminHomeController::class, 'orders_list'])->name("admin.orders.list");
    Route::get('/users_list', [adminHomeController::class, 'users_list'])->name("admin.users.list");
    Route::get('/colis_a_traiter', [adminHomeController::class, 'colis_a_traiter'])->name("admin.colis.traiter");
    Route::get('/returned_colis', [adminHomeController::class, 'returned_colis'])->name("admin.colis.returned");
    Route::post('/valid_user', [adminHomeController::class, 'valide_user'])->name("admin.valide.user");
    Route::post('/valid_bon_liv/{id}', [adminHomeController::class, 'valide_bon_livraison'])->name("admin.valide.bon.livraison");
    Route::post('/invalid_user', [adminHomeController::class, 'invalide_user'])->name("admin.invalide.user");
    Route::get('/bon_livraison', [adminHomeController::class, 'bon_livraison_list'])->name("admin.bon.livraison.list");
    Route::get('/view_bon_livraison/{id}', [adminHomeController::class, 'view_bon_livraison'])->name("admin.bon.livraison.view");
    Route::get('/untacked_orders', [adminHomeController::class, 'untacked_orders'])->name("admin.untacked_colis");
    Route::post('/send_request', [adminHomeController::class, 'send_order_request_to_livreur'])->name("admin.bon.send_request_to_admin");
    Route::get('/annuler_request/{id}', [adminHomeController::class, 'annuler_request'])->name('admin.annuler.request');
    Route::resource('manage_admin', manageAdminController::class);
    Route::resource('manage_livreur', manageLivreurController::class);
});

// for livreur
Route::middleware(['auth:sanctum', 'verified','livreur'])->prefix('livreur')->group(function () {
    Route::get('/', [livreurhomeController::class, 'index'])->name("livreur.home");
    Route::get('/colis', [livreurhomeController::class, 'colis_list'])->name("livreur.colis_list");
    Route::get('/request', [livreurhomeController::class, 'colis_request'])->name('livreur.request');
    Route::get('/my_colis', [livreurhomeController::class, 'my_colis'])->name("livreur.colis");
    Route::get('/order/{id}', [livreurhomeController::class, 'view_order'])->name("livreur.view.coli");
    Route::post('/modify_place', [livreurhomeController::class, 'place_now'])->name("livreur.place.now");
    Route::post('/take_order/{id}', [livreurhomeController::class, 'take_order'])->name("livreur.take.order");
    Route::post('/change_action', [livreurhomeController::class, 'change_action'])->name("livreur.change.action");
    Route::get('/order_list', [livreurhomeController::class, 'order_list'])->name('livreur.order.list');
    Route::get('/demarer/{id}', [livreurhomeController::class, 'liv_demarer'])->name('livreur.order.demarer'); // livreur demarer aprée collecte les coli
    Route::get('/colis_order/{id}', [livreurhomeController::class, 'colis_in_order'])->name('livreur.order.colis_list');
    Route::get('/order_action/{id}', [livreurhomeController::class, 'order_place_now'])->name('livreur.order.place_now');
    Route::get('/order_statue/{id}', [livreurhomeController::class, 'order_statue'])->name('livreur.order.statue');
    Route::get('/my_request', [livreurhomeController::class, 'order_request'])->name('livreur.colis.request');
    Route::get('/view_colis', [livreurhomeController::class, 'view_colis_of_bon'])->name('livreur.bon.view.colis');
    Route::post('/accepte_orders/{id}', [livreurhomeController::class, 'accepte_request'])->name('livreur.bon.accepte');
    Route::post('/refuse_orders/{id}', [livreurhomeController::class, 'refuse_request'])->name('livreur.bon.refuse');
    Route::post('/new_order', [livreurhomeController::class, 'nouveau_order'])->name("livreur.order.nouveau");
    Route::get('/my_orders', [livreurhomeController::class, 'my_orders'])->name('livreur.my_orders.list');
    Route::get('/new_orders', [livreurhomeController::class, 'new_orders'])->name('livreur.orders.new');
    Route::post('/demarer/{id}', [livreurhomeController::class, 'demarer'])->name("livreur.demarer");
});

// y4z^ctffJ(J@R&pnby!G
