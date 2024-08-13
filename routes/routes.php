<?php

use App\Core\Router;
use App\Controllers\UserController;

// User Index
Router::get('/users', [UserController::class,'index'])->name('user.index');

// User Store
Router::get('/users/create', [UserController::class,'create'])->name('user.create');
Router::post('/users', [UserController::class,'store'])->name('user.store');

// User Show
// Router::get('/users/show/{id}', [UserController::class,'show'])->name('user.show');

// // User Update
// Router::get('/users/edit/{id}', [UserController::class,'edit'])->name('user.edit');
// Router::put('/users/{id}', [UserController::class,'update'])->name('user.update');

// // User Delete
// Router::delete('/users/{id}', [UserController::class,'destroy'])->name('user.destroy');