<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\GoogleAuthController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
use App\Http\Controllers\QRController;

Route::get('/generate-qr', [QRController::class, 'generateQR']);


// Define la ruta para la lista de contactos
Route::get('/contacts', [GoogleAuthController::class, 'listContacts'])->name('contacts.list');

Route::post('/contacts/send', [GoogleAuthController::class, 'sendSelectedContacts'])->name('contacts.send');

Route::post('/contacts/final', [GoogleAuthController::class, 'storeFinalContacts'])->name('contacts.final');
Route::get('/contacts/final-list', [GoogleAuthController::class, 'finalList'])->name('contacts.final.list');
use App\Http\Controllers\InvitationController;

Route::get('/generate-invitations', [InvitationController::class, 'generateInvitations'])->name('generate.invitations');
