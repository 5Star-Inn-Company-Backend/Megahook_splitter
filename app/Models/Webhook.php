<?php

namespace App\Models;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Webhook extends Model
{
    use HasFactory;

    //const AUTHENTICATION_TYPES = ['No Authentication', 'Basic Authentication', 'Token','HMAC SHA1 HASH'];
    const STATUS_CODES = [
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        307 => '307 Temporary Redirect',
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported'
    ];

    protected $fillable = [
        'user_id',
        'input_name',
        'authentication_type',
        'response_code',
        'response_content_type',
        'response_content',
        'endpoint',
        'username',
        'password',
        'token_value',
        'signing_key',
        'string_format'
    ];


    public function WebhookBucket(){
        return $this->belongsTo(WebhookBucket::class);
    }

    public function destinations(){
        return $this->hasOne(Destination::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSuccessResponseCount(Builder $query, $statusCode):Builder
    {
        return $query->where('user_id', auth()->user()->id)->where('response_code', $statusCode);
    }

    public function scopeErrorResponseCount(Builder $query, $statusCode):Builder
    {
        return $query->where('user_id', auth()->user()->id)->where('response_code', $statusCode);
    }

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($webhook) {
            $webhook->endpoint = self::generateRandomCodes();
        });

    }


    public static function generateRandomCodes(){
        $code = Str::random(16); 

        $customCode = '';
        for ($i = 0; $i < strlen($code); $i++) {
          $char = $code[$i];
          if (ctype_alpha($char)) {
            $customCode .= (rand(0, 1) === 0) ? strtoupper($char) : $char; 
          } else {
            $customCode .= $char; 
          }
        }

        return $customCode;
    }
    
}
