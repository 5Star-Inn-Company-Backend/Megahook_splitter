<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserPlan;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestLogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PlanController;
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

    Route::get('webhooks', [WebhookController::class, 'index'])->name('webhook.index');
    Route::get('webhooks', [WebhookController::class, 'create'])->name('webhook.create');
    Route::get('webhooks/{webhook}', [WebhookController::class, 'edit'])->name('webhook.edit');
    Route::post('webhooks', [WebhookController::class, 'store'])->name('webhook.store');
    Route::put('webhooks/{webhook}', [WebhookController::class, 'update'])->name('webhook.update');
    Route::delete('webhooks/{webhook}', [WebhookController::class, 'destroy'])->name('webhook.destroy');

    Route::post('destinations/webhooks/{webhook}', [DestinationController::class, 'store']);
    Route::put('destinations/{destination}/webhooks/{webhook}', [DestinationController::class, 'update']);
    Route::delete('destinations/{destination}/webhooks', [DestinationController::class, 'destroy'])->name('destination.delete');


    Route::resource('payments', PaymentController::class);
    Route::get('payment-confirmation', [PaymentController::class,'confirmation']);
    Route::resource('request-log', RequestLogController::class);

});

Route::post('newsletter', NewsletterController::class);
Route::get('documentation', DocumentationController::class);
Route::get('pricing', PlanController::class);

require __DIR__ . '/auth.php';
