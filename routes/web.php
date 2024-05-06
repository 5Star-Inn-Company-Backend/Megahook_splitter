<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserPlan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\WebhookBucketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', CheckUserPlan::class])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('webhook-buckets', WebhookBucketController::class);

    Route::get('webhooks/{webhookBucket}', [WebhookController::class, 'create'])->name('webhook.create');
    Route::get('webhooks/{webhookBucket}/{webhook}', [WebhookController::class, 'edit'])->name('webhook.edit');
    Route::post('webhooks/{webhookBucket}', [WebhookController::class, 'store'])->name('webhook.store');
    Route::patch('webhooks/{webhookBucket}/{webhook}', [WebhookController::class, 'update'])->name('webhook.update');

    Route::post('destinations/webhooks/{webhook}', [DestinationController::class, 'store']);
    Route::put('destinations/{destination}/webhooks/{webhook}', [DestinationController::class, 'update']);
    Route::delete('destinations/{destination}/webhooks', [DestinationController::class, 'destroy'])->name('destination.delete');

});

require __DIR__ . '/auth.php';
