<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = [
        'webhook_id',
        'destination_name',
        'endpoint_url',
        'retry_policy',
        'authentication_type',
        'apply_recipe',
        'alert_on_failure',
    ];


    public function webhook(){
        return $this->belongsTo(Webhook::class);
    }
}
