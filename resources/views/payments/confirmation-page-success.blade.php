<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card"  style="width: 50rem; margin:0 auto;">
                        <div class="card-header text-center">
                            <h1 class="card-title font-weight-bold" style="font-size:2rem">Payment Confirmation</h1>
                        </div>
                        <div class="card-body">
                            <p class="text-center font-weight-bold">Your payment was successful!</p>
                            <div class="m-1">
                                <p>Amount : <strong>{{$payment->amount}}</strong></p>
                                <p>Payment reference : <strong>{{$payment->reference}}</strong></p>
                                <p>Status : <span class="badge badge-success font-weight-bold">{{$payment->status}}</span></p>
                                <p>Date: <strong>{{$payment->updated_at}}</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    <div class="text-center m-2">
                        <a href="{{ route('dashboard') }}" >Return to Home</a>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</x-main-layout>