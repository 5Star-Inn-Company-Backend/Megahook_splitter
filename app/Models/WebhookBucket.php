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


    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::created(function ($model) {
    //         try {
    //             $requestData = [
    //                 'headers' => Request::header(),
    //                 'body' => Request::all(),
    //                 // Any other data you want to log
    //             ];
    
    //             RequestLog::create([
    //                 'bucket' => 'your_bucket_name',
    //                 'input' => $requestData,
    //                 'destination' => 'your_destination',
    //                 'status' => 'pending', // or any default status
    //                 // Additional fields as needed
    //             ]);
    //         } catch (\Exception $e) {
    //             // Handle the exception (e.g., log it, notify administrators, etc.)
    //             // You might also want to rollback the model creation if necessary
    //             $model->delete(); // Rollback model creation
    //             // Log or report the error
    //             \Log::error('Error occurred while creating request log: ' . $e->getMessage());
    //         }
    //     });
    // }
    
    
}
