<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                <div class="p-6 text-gray-900">
                    <div>
                        <h1 class="p-1 font-weight-bold mb-3" style="font-size:18px">Create Webhook</h1>
                    </div>

                    <form action="{{ route('webhook.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="input-type">Name</label>
                            <input type="text" name="input_name" class="form-control"
                                value="{{ old('input_name') }}" placeholder="Enter Webhook name"/>
                            <x-input-error :messages="$errors->get('input_name')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <label for="input-type">Authentication Type</label>
                            <select name="authentication_type" id="auth-type" class="form-control">
                                <option value="" disabled selected>Choose Authentication Type</option> 
                                    <option value="">No Authentication</option>                         
                                    <option value="basic">Basic Authentication</option>
                                    <option value="token">Token</option>
                                    <option value="hmac">HMAC</option>
                            </select>
                            <x-input-error :messages="$errors->get('authentication_type')" class="mt-2" />
                        </div>

                        <div id="basic-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username') }}" placeholder="Enter username"/>
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control"
                                    value="{{ old('password') }}" placeholder="Enter password"/>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div id="token-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="token">Token</label>
                                <input type="text" name="token" class="form-control"
                                    value="{{ old('token') }}" placeholder="Enter token"/>
                                <x-input-error :messages="$errors->get('token')" class="mt-2" />
                            </div>

                        </div>

                        <div id="hmac-auth-fields" style="display: none;">
                            <div class="form-group">
                                <label for="hmac">HMAC</label>
                                <input type="text" name="hmac" class="form-control"
                                    value="{{ old('hmac') }}" placeholder="Enter hmac"/>
                                <x-input-error :messages="$errors->get('hmac')" class="mt-2" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="input-type">Response Code</label>
                            <select name="response_code" id="" class="form-control">
                                <option value="" disabled selected>Choose Response Code</option>
                                @foreach ($statusCodes as $key => $code)
                                    <option value="{{ $key }}">{{ $code }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('response_code')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <label for="input-type">Response Content Type</label>
                            <select name="response_content_type" id="" class="form-control">
                                <option value="" disabled selected>Choose Content Type</option>
                                    <option value="text/plain">TEXT</option>
                                    <option value="json">JSON</option>
                                    <option value="xml">XML</option>
                            </select>
                            <x-input-error :messages="$errors->get('response_content_type')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="input-type">Response Content</label>
                            <textarea name="response_content" class="form-control" placeholder="Enter Response Content"></textarea>
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
