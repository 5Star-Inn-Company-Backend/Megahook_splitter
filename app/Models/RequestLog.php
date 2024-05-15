<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;
    protected $fillables = [
        'user_id','bucket','input','destination','status',
        'attempts','response_code','sent_at','last_attempt_at'
    ];

   
   protected function casts(): array
   {
       return [
           'input' => 'json',
           'destination' => 'json',
       ];
   }

}
