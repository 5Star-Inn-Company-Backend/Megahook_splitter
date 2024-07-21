<?php

namespace App\Enums;

use App\Plans\BasicPlan;
use App\Plans\FreePlan;
use App\Plans\Plans;
use App\Plans\PremiumPlan;

enum Plan:string
{
     case FREE = 'free';
     case BASIC = 'basic';
     case PREMIUM = 'premium';

     public function createPlan():Plans
     {
        return match($this){
        self::FREE => new FreePlan(),
        self::BASIC => new BasicPlan(),
        self::PREMIUM => new PremiumPlan()
     }; 
    }

}
