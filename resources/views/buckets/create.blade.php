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
                            <h1 class="p-1 font-weight-bold mb-3"  style="font-size:18px">Create Input field</h1>
                        </div>

                        <form action="{{route('webhook.store',$webhookBucket->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="input-type">Input Name</label>
                                <input type="text" name="input_name" class="form-control"  value="{{old('input_name')}}"/>
                                <x-input-error :messages="$errors->get('input_name')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="input-type">Authentication Type</label>
                                <select name="authentication_type" id="" class="form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($authenticationTypes as $key => $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('authentication_type')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="input-type">Response Code</label>
                                <select name="response_code" id="" class="form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($statusCodes as $key => $code)
                                        <option value="{{ $code }}">{{ $code }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('response_code')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label for="input-type">Response Content Type</label>
                                <input type="text"  value="text/plain; charset=utf-8;" name="response_content_type" class="form-control" />
                                <x-input-error :messages="$errors->get('response_content_type')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="input-type">Input Type</label>
                                <textarea name="response_content" class="form-control"> Message Received</textarea>
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
