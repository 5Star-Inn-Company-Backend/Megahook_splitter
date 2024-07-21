<?php

namespace App\Plans;

interface Plans
{
     public function maxWebhookBucket():int;
     public function maxDestinations():int;
     public function requestLogRetention ():int;
     public function throughput ():int;
     public function retryPolicy ():bool;
     public function authenticationType ():string|array;
}
