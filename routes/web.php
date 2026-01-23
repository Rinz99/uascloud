<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FirebaseController::class, 'index']);
Route::get('/dashboard', [FirebaseController::class, 'index']);

Route::get('/firebase-test', [FirebaseController::class, 'test']);

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/firebase-login', [FirebaseController::class, 'firebaseLogin']);

Route::get('/form-data', function () {
    return view('form-data');
});

Route::post('/simpan-data', [FirebaseController::class, 'store']);


