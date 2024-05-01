<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebhookBucket extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function webhooks(){
        return $this->hasMany(Webhook::class);
    }
}
