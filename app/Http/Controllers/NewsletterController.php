<?php

namespace App\Http\Controllers;

use App\Services\MailChimp\Newsletter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Newsletter $newsletter)
    {
         
        request()->validate([
            'email' => 'required|email'
        ]);

         

        try{
            $newsletter->subscribe(request('email'));
        }catch(Exception $e){
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list'
            ]);
        }

        return redirect('/')->with('success', 'you are now signed up for our newsletter');
    }
}
