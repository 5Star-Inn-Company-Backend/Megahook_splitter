<?php

namespace App\Http\Requests;

use App\Models\Webhook;
use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
{

   
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'input_name' => ['required', 'string'],
            'authentication_type' => ['required', 'string'],
            'response_code' => ['required', 'int'],
            'response_content_type' => ['required', 'string'],
            'response_content' => ['required', 'string'],
            'username' => ['nullable', 'string'],
            'password' => ['nullable', 'string'],
            'token_location' => ['nullable', 'sometimes', 'string'],
            'token_variable' => ['nullable', 'sometimes', 'string'],
            'token_value' => ['nullable', 'string'],
            'signing_key' => ['nullable', 'sometimes', 'string'],
            'string_format' => ['nullable', 'sometimes', 'string'],
        ];

        if($this->input('authentication_type') === Webhook::BASIC)
        {
            $rules['username'] = 'required';
            $rules['password'] = 'required';
        }

        if($this->input('authentication_type') === Webhook::TOKEN)
        {
            $rules['token_value'] = 'required';
        }
    }
}
