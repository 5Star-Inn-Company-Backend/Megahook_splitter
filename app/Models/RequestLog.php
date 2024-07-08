<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestLog extends Model
{
    use HasFactory;
    protected $fillable = [
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


   public function user():BelongsTo
   {
        return $this->belongsTo(User::class);
   }

//    public function bucket():BelongsTo
//    {
//         return $this->belongsTo(WebhookBucket::class);
//    }

}
