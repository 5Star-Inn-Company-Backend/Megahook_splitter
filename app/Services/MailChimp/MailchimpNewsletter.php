<?php
namespace App\Services\MailChimp;

use App\Services\MailChimp\Newsletter;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {
        
    }

    public function subscribe(string $email)
    {
       

    return $this->client->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
        "email_address" => $email,
        "status" => "subscribed",
    ]);

    }

}

