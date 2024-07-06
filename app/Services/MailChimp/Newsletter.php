<?php
namespace App\Services\MailChimp;

use MailchimpMarketing\ApiClient;

interface Newsletter
{

   

    public function subscribe(string $email);

}

