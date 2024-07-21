<?php

namespace App\Plans;

class FreePlan implements Plans
{
    
    public function maxWebhookBucket():int
    {
        return 1;
    }
    public function maxDestinations():int
    {
        return 2;
    }
    public function requestLogRetention ():int
    {
        return 7;
    }
    public function throughput ():int
    {
        return 10;
    }
    public function retryPolicy ():bool
    {
        return false;
    }
    public function authenticationType ():string
    {
        return "basic";
    }
}
