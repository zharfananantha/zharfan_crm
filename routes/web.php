<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login-store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('register.')
    ->group(function () {
        Route::get('/register', function () {
            return view('register');
        })->name('register');
        
        Route::post('/register-store', [AuthController::class, 'register'])->name('register-store');
        
    });

Route::middleware([AuthMiddleware::class])
    ->group(function() {
        Route::name('leads.')
            ->prefix('leads')
            ->group(function () {
                Route::get('/', function () {
                    return view('leads.lead');
                })->name('leads');

                Route::get('/create', function () {
                    return view('leads.create');
                })->name('create');
        
                Route::post('/leads-store', [LeadController::class, 'store'])->name('store');
                
            });

        Route::name('customers.')
            ->prefix('customers')
            ->group(function () {
                Route::get('/', function () {
                    return view('customers.customer');
                })->name('customers');
                
            });

        Route::name('products.')
            ->prefix('products')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('products');
                Route::get('/create/{id?}', [ProductController::class, 'create'])->name('create');
                Route::post('/product-store', [ProductController::class, 'store'])->name('store');
                
            });
    
        Route::name('projects.')
            ->prefix('projects')
            ->group(function () {
                Route::get('/', function () {
                    return view('projects.projects');
                })->name('projects');
                
            });
    });
