<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ActivatePlanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Payment $payment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payment = $this->payment;
        // if ($payment->type == 'App\Models\Plan') {
        //     $plan = Plan::findOrFail($payment->type_id);
        //     if($plan){
        //         $payment->user->plans()->attach($plan, ['expires_at' => now()->addMonth(), 'status' => Plan:: ACTIVE]);
        //     }
        // }

        if ($payment->type == 'App\Models\Plan') {
            $plan = Plan::findOrFail($payment->type_id);
            if ($plan) {
                // Detach the existing plan
                $payment->user->plans()->detach();
                
                // Attach the new plan
                $payment->user->plans()->attach($plan, [
                    'expires_at' => now()->addMonth(),
                    'status' => Plan::ACTIVE
                ]);
            }
        }
        
    }
}
