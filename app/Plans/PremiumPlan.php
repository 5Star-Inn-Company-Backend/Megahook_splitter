<?php

namespace App\Plans;

class PremiumPlan implements Plans
{
    public function maxWebhookBucket():int
    {
        return 100;
    }
    public function maxDestinations():int
    {
        return 50;
    }
    public function requestLogRetention ():int
    {
        return 180;
    }
    public function throughput ():int
    {
        return 100;
    }
    public function retryPolicy ():bool
    {
        return true;
    }
    public function authenticationType ():array
    {
        return ["basic", "token", 'hmac'];
    }
}
