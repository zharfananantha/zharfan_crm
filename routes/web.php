<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/leads', function () {
    return view('leads.lead');
})->name('leads');

Route::get('/customers', function () {
    return view('customers.customer');
})->name('customers');

Route::get('/products', function () {
    return view('products.product');
})->name('products');

Route::get('/projects', function () {
    return view('projects.projects');
})->name('projects');
