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
                            <select name="authentication_type" id="" class="form-control">
                                <option value="" disabled selected>Choose Authentication Type</option>
                                @foreach ($authenticationTypes as $key => $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('authentication_type')" class="mt-2" />
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
