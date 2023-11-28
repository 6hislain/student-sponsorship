<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UpdateController;
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

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/about', [DefaultController::class, 'about'])->name('about');
Route::get('/contact', [DefaultController::class, 'contact'])->name('contact');
Route::get('/license', [DefaultController::class, 'license'])->name('license');
Route::get('/dashboard', [DefaultController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/report', [DefaultController::class, 'report'])->name('report');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard/user', [AuthController::class, 'users'])->name('user.index');
Route::get('/dashboard/user/{user}', [AuthController::class, 'profile'])->name('user.show');

Route::resources([
    'child' => ChildController::class,
    'sponsor' => SponsorController::class,
    'payment' => PaymentController::class,
    'update' => UpdateController::class,
    'application' => ApplicationController::class,
]);
