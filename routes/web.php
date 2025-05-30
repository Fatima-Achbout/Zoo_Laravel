<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserloginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\ZooController;
use App\Http\Controllers\DownloadTicket;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnimalController;

// Pages publiques
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Tickets et panier (public)
Route::get('/tickets', [CartController::class, 'showOffers'])->name('tickets.offers');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart/remove/{index}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/order', [CartController::class, 'order'])->name('order.post');
Route::get('/order-success', [CartController::class, 'orderSuccess'])->name('order.success');

// Paiement
// Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment.form');
// Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

// Authentification utilisateur
Route::get('/login', [UserloginController::class,'showlogin'])->name('login');
Route::post('/login', [UserloginController::class,'login']);
Route::post('/logout', [UserloginController::class, 'logout'])->name('logout');

// Inscription utilisateur
Route::get('/register', [UserRegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [UserRegisterController::class, 'register']);

// Profil (auth nécessaire)
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::get('/ticket/download/{orderId}', [DownloadTicket::class, 'downloadTicket'])->name('ticket.download')->middleware('auth');

// Tableau de bord utilisateur classique (si besoin)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ZooController::class, 'index'])->name('dashboard');
});

// Routes admin
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('animals', AnimalController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('ticket-types', App\Http\Controllers\Admin\TicketTypeController::class);
    Route::get('/tickets', [App\Http\Controllers\Admin\TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets/acheter', [App\Http\Controllers\Admin\TicketController::class, 'acheterBillet'])->name('tickets.acheter');
    Route::post('animals/{animal}/status', [AnimalController::class, 'updateStatus'])->name('animals.updateStatus');
});