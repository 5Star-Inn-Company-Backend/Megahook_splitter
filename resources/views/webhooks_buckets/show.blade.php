<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook Bucket') }}
            </h2>
        </div>
    </x-slot>

 
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                    <div class="p-6 text-gray-900">
                        <div class="d-flex" style="justify-content: space-between">
                            <h1 class="font-weight-bold" style="font-size:20px">{{ $webhookBucket->name }}</h1>
                            <div>
                                <a href="{{ route('webhook.create', $webhookBucket->id) }}"
                                    class="btn btn-primary ">
                                    create new input <i class="fa fa-plus"></i>
                                </a>
                                <button type="button" class="btn btn-warning "
                                    onclick="editBucketBtn({{ $webhookBucket }})" style="cursor:pointer"
                                    data-toggle="modal" data-target="#editBucket" id="edit-bucket-btn">
                                    edit bucket <i class="fa fa-pen"></i>
                                </button>
                                <form class="d-inline" action="{{route('webhook-buckets.destroy',$webhookBucket->id)}}" method="post"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">delete <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <!-- The First FAQ -->
                    @foreach ($webhookBucket->webhooks as $webhook)
                        <details class="bg-gray-300 open:bg-amber-200 duration-300 my-1 mb-2">
                            <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">{{ $webhook->input_name }}
                            </summary>
                            <div class="bg-white px-5 py-3 border border-gray-300 text-sm font-light">
                                <div class="mb-2">
                                    <p>Incoming Endpoint:</p>
                                    <input type="text" disabled value="{{ $webhook->endpoint }}"
                                        class="form-control" />
                                </div>

                                <div class="my-3">
                                    <button type="button" class="btn btn-success" data-target="#createDestination"
                                        data-toggle="modal" onclick="createNewDestination({{ $webhook->id }})">
                                        new destination <i class="fa fa-plus"></i>
                                    </button>
                                    <a href="{{ route('webhook.edit', [$webhookBucket, $webhook]) }}"
                                        class="btn btn-secondary "> edit <i class="fa fa-pen"></i></a>
                                </div>

                                @if(!$webhook->destinations->isEmpty())
                              
                                @foreach ( $webhook->destinations as $destination )
                                
                                <div class="card my-2">
                                    <div class="card-header d-flex" style="justify-content: space-between">
                                        <h1 class="font-weight-bold" style="font-size: 20px;">{{$destination->destination_name}}</h1>
                                        <div>
                                            <button type="button" class="btn  btn-primary" data-target="#editDestination" 
                                            data-toggle="modal" onclick="editDestination({{$webhook->id}}, {{$destination}})">edit destination <i class="fa fa-pen"></i></button>
    
                                            <form class="d-inline" action="{{route('destination.delete',$destination->id)}}" method="post"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">delete <i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h1>Destination endpoints:</h1>
                                            <p class="font-weight-bold" style="font-size: 12px;">{{$destination->endpoint_url}}</p>
                                        </div>

                                        <div class="row m-1" style="height: 120px; text-align:center;">
                                            <div class="col-md-2" style="background: #4083be">

                                            </div>
                                            <div class="col-md-2 pt-5" style="border-radius:5px; background:#9cbfdd">
                                                <p class="mb-4" style="font-size:35px">0</p>
                                                <p>Success</p>
                                            </div>
                                            <div class="col-md-2 pt-5" style="border-radius:5px; background:#1d3b55">
                                                <p class="mb-4" style="font-size:35px">0</p>
                                                <p>Failed</p>
                                            </div>
                                            <div class="col-md-2 pt-5" style="border-radius:5px; background:#7c8184">
                                                <p class="mb-4" style="font-size:35px">0</p>
                                                <p>Queued</p>
                                            </div>
                                            <div class="col-md-2 pt-5" style="border-radius:5px; background:#8496a9">
                                                <p class="mb-4" style="font-size:35px">0</p>
                                                <p>Pending</p>
                                            </div>
                                            <div class=" col-md-2 pt-5" style="border-radius:5px; background:#3e5c74">
                                                <p class="mb-4" style="font-size:35px">0</p>
                                                <p>Filtered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              
                                @else
                                <div class="border mt-3" style="border-radius:5px">
                                    <p class="bg-info m-2 text-center text-white p-3" style="font-size: 13px;" > Heads up! You don't have any destinations setup for this endpoint. Click 
                                        <button type="button" class="btn-link" data-target="#createDestination" data-toggle="modal">here
                                    </button>
                                        to setup a destination for this webhook!</p>
                                </div>
                                @endif
                        </details>
                    @endforeach
            </div>
        </div>
    </div>



    @include('destinations.create-modal')
    @include('webhooks_buckets.edit-bucket-modal')
    @include('destinations.edit-modal')
</x-main-layout>
