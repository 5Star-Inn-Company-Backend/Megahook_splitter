<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomingWebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 Route::any('incoming/{id}',  [IncomingWebhookController::class, 'incoming'])
    ->name('incoming.webhook');
    //->middleware('webhook');