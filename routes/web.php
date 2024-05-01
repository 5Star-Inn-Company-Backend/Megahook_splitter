<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserPlan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebhookBucketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class,'index'])
     ->middleware(['auth', 'verified', CheckUserPlan::class])
     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('webhook-buckets', WebhookBucketController::class);
Route::get('webhooks/{webhookBucket}', [WebhookController::class,'create'])->name('webhook.create');
Route::post('webhooks/{webhookBucket}', [WebhookController::class,'store'])->name('webhook.store');

require __DIR__.'/auth.php';
