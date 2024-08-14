<?php

use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\ProductController;

// User Index
Router::get('/users', [UserController::class,'index'])->name('user.index');

// User Store
Router::get('/users/create', [UserController::class,'create'])->name('user.create');
Router::post('/users', [UserController::class,'store'])->name('user.store');

// User Show
Router::get('/users/show/{id}', [UserController::class,'show'])->name('user.show');

// User Update
Router::get('/users/edit/{id}', [UserController::class,'edit'])->name('user.edit');
Router::put('/users/{id}', [UserController::class,'update'])->name('user.update');

// User Delete
Router::delete('/users/{id}', [UserController::class,'destroy'])->name('user.destroy');

// Product Index
Router::get('/products', [ProductController::class,'index'])->name('product.index');

// Product Store
Router::get('/products/create', [ProductController::class,'create'])->name('product.create');
Router::post('/products', [ProductController::class,'store'])->name('product.store');

// Product Show
Router::get('/products/show/{id}', [ProductController::class,'show'])->name('product.show');

// Product Update
Router::get('/products/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Router::put('/products/{id}', [ProductController::class,'update'])->name('product.update');

// Product Delete
Router::delete('/products/{id}', [ProductController::class,'destroy'])->name('product.destroy');