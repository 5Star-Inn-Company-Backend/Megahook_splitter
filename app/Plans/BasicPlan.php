<?php

namespace App\Plans;

class BasicPlan implements Plans
{
    public function maxWebhookBucket():int
    {
        return 5;
    }
    public function maxDestinations():int
    {
        return 30;
    }
    public function requestLogRetention ():int
    {
        return 7;
    }
    public function throughput ():int
    {
        return 50;
    }
    public function retryPolicy ():bool
    {
        return false;
    }
    public function authenticationType ():array
    {
        return ["basic", "token"];
    }
}
