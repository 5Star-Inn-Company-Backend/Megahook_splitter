<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    const PAYMENT_TYPE_KORAPAY = 'korapay';

    const PENDING ='pending', SUCCESS = 'success', FAILED = 'failed';
    
    protected $fillable =[
        'user_id',
        'reference',
        'type',
        'type_id',
        'amount',
        'status',
        'payment_gateway_name'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
