<?php

use App\Http\Controllers\produitsController;
use App\Http\Controllers\panierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\UserController;

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
})->name('home');
Route::get('/contact', [App\Http\Controllers\contactController::class, 'create'])->name('contact');
Route::post('/contact', [App\Http\Controllers\contactController::class, 'store'])->name('contact.send');
 
Route::get('/inscription', [App\Http\Controllers\userController::class, 'show'])->name('inscription');
Route::post('/inscription', [App\Http\Controllers\userController::class, 'inscrire'])->name('inscription.send');
Route::get('/connexion', [App\Http\Controllers\userController::class, 'connexion'])->name('connexion');
Route::post('/connexion', [App\Http\Controllers\userController::class, 'connexionSend'])->name('connexion.send');
Route::post('/deconnecter', [App\Http\Controllers\userController::class, 'deconnecter'])->name('deconnecter');

// Routes pour l'affichage des produits (accessibles à tous)
Route::get('/produits',[produitsController::class, 'index'])->name('produits.index');   
Route::get('/produits/{produit}',[produitsController::class, 'show'])->name('produits.show');

Route::middleware(['auth.required'])->group(function () {
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::post('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
    Route::post('/panier/update/{id}', [PanierController::class, 'update'])->name('panier.update');
    Route::get('/commande', [CommandeController::class, 'form'])->name('commande.form');
    Route::post('/commande', [CommandeController::class, 'submit'])->name('commande.submit');
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])->name('mes.commandes');
});

Route::middleware(['auth.required', 'admin'])->group(function () {
    // Messages
    Route::get('/messages', [contactController::class, 'messages'])->name('messages');
    Route::delete('/messages/{id}', [contactController::class, 'destroy'])->name('messages.destroy');

    // Administration des produits
    Route::get('/add',[produitsController::class, 'add'])->name('add');
    Route::post('/produits',[produitsController::class, 'store'])->name('produits.store');
    Route::delete('/supprimer/{produit}', [App\Http\Controllers\produitsController::class, 'supprimer'])->name('supprimer');
    Route::get('/modifier/{produit}/edit', [App\Http\Controllers\produitsController::class, 'modifierform'])->name('modifier');
    Route::put('/modifier/{produit}', [App\Http\Controllers\produitsController::class, 'modifier'])->name('modifier.produit');
    Route::get('/users', [userController::class, 'usersliste'])->name('usersliste');
    Route::post('/users/{id}/role', [userController::class, 'updateRole'])->name('users.updateRole');
    

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'listeCommandes'])->name('commandes.liste');
    Route::put('/commande/{id}/statut', [CommandeController::class, 'updateStatut'])->name('commande.update.statut');
});



