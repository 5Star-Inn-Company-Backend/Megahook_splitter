<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Request log') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-4 pt-6 pb-8 bg-white rounded shadow-lg">
  <h1 class="text-3xl font-bold mb-4">Payload Details</h1>
  <hr>
  <div class="flex items-center mb-4 pt-4">
    <span class="text-lg font-semibold mr-2">Bucket:</span>
    <span class="text-gray-600"> {{$request_log->bucket}} </span>
  </div>
  <div class="flex items-center mb-4">
    <span class="text-lg font-semibold mr-2">Name:</span>
    <span class="text-gray-600"> {{$request_log->user->name}} </span>
  </div>
  <div class="flex items-center mb-4">
    <span class="text-lg font-semibold mr-2">Destination:</span>
    <span class="text-gray-600"> {{$request_log->destination}} </span>
  </div>

  <div class="flex items-center mb-4">
    <span class="text-lg font-semibold mr-2">Status:</span>
    <span style="background-color: green;" class="text-white px-4 py-2 text-sm border border-transparent rounded-full"> {{$request_log->status}} </span>
  </div>
  <!-- Add more fields as needed -->
</div>


     

</x-main-layout>
