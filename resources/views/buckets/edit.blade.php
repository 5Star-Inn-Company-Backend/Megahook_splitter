<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                <div class="p-6 text-gray-900" style="background: #1bac91;">
                    <div style="color:#fff">
                        <h1 class="font-weight-bold" style="font-size:25px">{{ $webhookBucket->name }}</h1>
                    </div>
                </div>
            </div>
        </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                    <div class="p-6 text-gray-900">
                        <div>
                            <h1 class="p-1 font-weight-bold mb-3"  style="font-size:18px">Edit Input field</h1>
                        </div>

                        <form action="{{route('webhook.update', $webhook)}}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="form-group">
                            <label for="input-type">Name</label>
                            <input type="text" name="input_name" class="form-control"
                                value="{{ old('input_name', $webhook->input_name) }}" placeholder="Enter Webhook name" autocomplete="false"/>
                            <x-input-error :messages="$errors->get('input_name')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <label for="input-type">Authentication Type</label>
                            <select name="authentication_type" id="auth-type" class="form-control">
                                <option value="{{ old('authentication_type',) }}" disabled selected>Choose Authentication Type</option> 
                                    <option value="no_auth" {{$webhook->authentication_type == 'no_auth'?'selected' : ''}}>No Authentication</option>                         
                                    <option value="basic" {{$webhook->authentication_type == 'basic'?'selected' : ''}}>Basic Authentication</option>
                                    <option value="token" {{$webhook->authentication_type == 'token'?'selected' : ''}}>Token</option>
                                    <option value="hmac" {{$webhook->authentication_type == 'hmac'?'selected' : ''}}>HMAC</option>
                            </select>
                            <x-input-error :messages="$errors->get('authentication_type')" class="mt-2" />
                        </div>

                        <div id="basic-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $webhook?->username) }}" placeholder="Enter username"/>
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{ old('password', $webhook?->password) }}" placeholder="Enter password"/>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div id="token-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="token">Token</label>
                                <input type="text" name="token_value" class="form-control"
                                    value="{{ old('token_value', $webhook?->token_value) }}" placeholder="Enter token value"/>
                                <x-input-error :messages="$errors->get('token_value')" class="mt-2" />
                            </div>

                        </div>

                        <div id="hmac-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="signing_key">SignIn Key</label>
                                <input type="text" name="signing_key" class="form-control"
                                    value="{{ old('signing_key', $webhook?->signing_key) }}" placeholder="Enter signing key"/>
                                <x-input-error :messages="$errors->get('signing_key')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="hmac">String Format</label>
                                <input type="text" name="string_format" class="form-control"
                                    value="{{ old('string_format', $webhook?->string_format) }}" placeholder="Enter string format"/>
                                <x-input-error :messages="$errors->get('string_format')" class="mt-2" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="input-type">Response Code</label>
                            <select name="response_code" id="" class="form-control">
                                <option value="" disabled selected>Choose Response Code</option>
                                @foreach ($statusCodes as $key => $code)
                                    <option value="{{ $key }}" {{$webhook->response_code == $key ?'selected' : ''}}>{{ $code }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('response_code')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <label for="input-type">Response Content Type</label>
                            <select name="response_content_type" id="" class="form-control">
                                <option value="" disabled selected>Choose Content Type</option>
                                    <option value="text" {{$webhook->response_content_type == 'text'?'selected' : ''}}>TEXT</option>
                                    <option value="json" {{$webhook->response_content_type == 'json'?'selected' : ''}}>JSON</option>
                                    <option value="xml" {{$webhook->response_content_type == 'xml'?'selected' : ''}}>XML</option>
                            </select>
                            <x-input-error :messages="$errors->get('response_content_type')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="input-type">Response Content</label>
                            <textarea name="response_content" class="form-control" placeholder="Enter Response Content">{{$webhook->response_content}}</textarea>
                            <x-input-error :messages="$errors->get('response_content')" class="mt-2" />
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn-lg btn-success" value="Save" />
                        </div>
                    </form>
                      
                    </div>
                </div>
            </div>
        </div>

</x-main-layout>

<script>
 
 document.addEventListener('DOMContentLoaded', function() {
    const authTypeSelect = document.getElementById('auth-type');
    const basicAuthFields = document.getElementById('basic-auth-fields');
    const tokenAuthFields = document.getElementById('token-auth-fields');
    const hmacAuthFields = document.getElementById('hmac-auth-fields');

    if(authTypeSelect){
        authTypeSelect.addEventListener('change', function() {
        if (this.value === 'basic') {
            basicAuthFields.style.display = 'block';
            tokenAuthFields.style.display = 'none';
            hmacAuthFields.style.display = 'none';
        }else if(this.value === 'token'){
            tokenAuthFields.style.display = 'block';
            basicAuthFields.style.display = 'none';
            hmacAuthFields.style.display = 'none';
        } 

        else if(this.value === 'hmac'){
            hmacAuthFields.style.display = 'block';
            tokenAuthFields.style.display = 'none';
            basicAuthFields.style.display = 'none';
        } 
        
        else {
            basicAuthFields.style.display = 'none';
            tokenAuthFields.style.display = 'none';
            hmacAuthFields.style.display = 'none';
        }
    });
    }
   
});



</script>
