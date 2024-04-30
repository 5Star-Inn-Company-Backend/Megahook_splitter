<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
          'basic' => [
              'name' =>'Basic',
              'price' => 29,
              'description' => '10K Monthly Requests,5 User Accounts,25 Destinations,30 Day Message Retention,Overage: $0.02 / msg'
          ],
          'business' => [
            'name' => 'Business',
            'price' => 149,
            'description' => '100K Monthly Requests,25 User Accounts,999 Destinations,60 Day Message Retention,Overage: $0.015 / msg,
            API Access,Provider Access,Applications'
          ],
          'business_plus' => [
            'name' => 'Business Plus',
            'price' => 399,
            'description' => '500K Monthly Requests,999 User Accounts,999 Destinations,120 Day Message Retention,
            Overage: $0.012 / msg,API Access,Provider Access,Applications'
          ],
          'developer' => [
            'name' => 'Developer',
            'price' => 0.00,
            'description' => '100 Monthly Requests,1 User Accounts,5 Destinations,7 Day Message Retention,Overage: $0 / msg,
            API Access,Provider Access,Applications'
          ]
          ];

        
        Plan::firstOr(function() use($plans){
            foreach($plans as $plan){
                plan::create($plan);
            }
        });
         

       
    }
}
