<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    const ACTIVE = 'active', ENDED = 'ended', CANCELLED = 'cancelled';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
