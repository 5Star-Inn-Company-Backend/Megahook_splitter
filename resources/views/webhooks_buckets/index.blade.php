<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook Bucket') }}
            </h2>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <a href="{{ route('webhook.create') }}"
                    style="background: #1bac91; color:#fff; padding: 5px; border-radius:5px; cursor: pointer;">
                    {{ __('Add Bucket') }} <i class="fa fa-plus m-1" style="color: #fff"></i>
                </a>
                {{-- <button style="background: #1bac91; color:#fff; padding: 5px; border-radius:5px; cursor: pointer;"
                    data-toggle="modal" data-target="#createBucket">
                    {{ __('Add Bucket') }} <i class="fa fa-plus m-1" style="color: #fff"></i>
                </button> --}}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- The First FAQ -->
            @foreach ($webhooks as $webhook)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                    <div class="mt-2">
                        <details class="duration-300 my-1 mb-2">
                            <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">{{ $webhook->input_name }}
                                <div class="float-right mb-1">
                                    <a href="{{ route('webhook.edit', $webhook) }}"
                                        class="btn btn-warning "> edit <i class="fa fa-pen"></i></a>
                                    {{-- <button type="button" class="btn btn-warning "
                                                onclick="editBucketBtn({{ $webhook }})" style="cursor:pointer"
                                                data-toggle="modal" data-target="#editBucket" id="edit-bucket-btn">
                                                edit bucket <i class="fa fa-pen"></i>
                                            </button> --}}
                                    <form class="d-inline" action="{{ route('webhook.destroy', $webhook->id) }}"
                                        method="post" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">delete <i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </summary>




                            <div class="bg-white px-5 py-3 border border-gray-300 text-sm font-light">
                                <div class="mb-2">
                                    <p>Incoming Endpoint:</p>
                                    <input type="text" disabled value="{{ route('incoming.webhook', $webhook->endpoint) }}"
                                        class="form-control" />
                                </div>

                                <div class="my-3">
                                    <button type="button" class="btn btn-success" data-target="#createDestination"
                                        data-toggle="modal" onclick="createNewDestination({{ $webhook->id }})">
                                        new destination <i class="fa fa-plus"></i>
                                    </button>
                                    {{-- <a href="{{ route('webhook.edit', $webhook) }}" class="btn btn-secondary "> edit <i
                                            class="fa fa-pen"></i></a> --}}
                                </div>
                                @if (!$webhook->destinations->isEmpty())
                                    @foreach ($webhook->destinations as $destination)
                                        <div class="card my-2">
                                            <div class="card-header d-flex" style="justify-content: space-between">
                                                <h1 class="font-weight-bold" style="font-size: 20px;">
                                                    {{ $destination->destination_name }}</h1>
                                                <div>
                                                    <button type="button" class="btn  btn-primary"
                                                        data-target="#editDestination" data-toggle="modal"
                                                        onclick="editDestination({{ $webhook->id }}, {{ $destination }})">edit
                                                        destination <i class="fa fa-pen"></i></button>

                                                    <form class="d-inline"
                                                        action="{{ route('destination.delete', $destination->id) }}"
                                                        method="post" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">delete <i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <h1>Destination endpoints:</h1>
                                                    <p class="font-weight-bold" style="font-size: 12px;">
                                                        {{ $destination->endpoint_url }}</p>
                                                </div>

                                                <div class="row m-1" style="height: 120px; text-align:center; display:flex; justify-content:center;">
                                                
                                                    <div class="col-md-2 pt-5"
                                                        style="border-radius:5px; background:#90EE90; margin-right:3rem">
                                                        <p class="mb-4" style="font-size:35px">{{$successResponseCode}}</p>
                                                        <p>Success</p>
                                                    </div>
                                                    <div class="col-md-2 pt-5"
                                                        style="border-radius:5px; background:#FF474C; margin-right:3rem">
                                                        <p class="mb-4" style="font-size:35px">{{$failedResponseCode}}</p>
                                                        <p>Failed</p>
                                                    </div>
                                                    <div class="col-md-2 pt-5"
                                                        style="border-radius:5px; background:#7c8184; margin-right:3rem">
                                                        <p class="mb-4" style="font-size:35px">0</p>
                                                        <p>Queued</p>
                                                    </div>
                                                    <div class="col-md-2 pt-5"
                                                        style="border-radius:5px; background:#FFFFED; margin-right:3rem">
                                                        <p class="mb-4" style="font-size:35px">0</p>
                                                        <p>Pending</p>
                                                    </div>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="border mt-3" style="border-radius:5px">
                                        <p class="bg-info m-2 text-center text-white p-3" style="font-size: 13px;">
                                            Heads
                                            up! You don't have any destinations setup for this endpoint. Click
                                            <button type="button" class="btn-link" data-target="#createDestination"
                                                data-toggle="modal">here
                                            </button>
                                            to setup a destination for this webhook!
                                        </p>
                                    </div>
                                @endif
                        </details>
                    </div>


                </div>
            @endforeach
        </div>

    </div>


    <div class="modal fade" id="createBucket" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">

                    <section id="pricing" class="pricing">
                        <div class="container" data-aos="fade-up">
                            <h3 style="color:#1bac91" class="font-weight-bold">Add New Bucket</h3>
                            <label for="bucket name"> Enter a name for your bucket and save</label>
                            <form action="" method="post" id="bucketFormId">
                                <p id="error" class="text-danger p-2" style="display: none"></p>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bucket-name" name="name"
                                        placeholder="Enter bucket name" />
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn w-25" id="submitBtn"
                                        style="background: #1bac91; color :#fff">
                                        save

                                    </button>
                                </div>

                            </form>
                        </div>
                    </section>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                </div>
            </div>
        </div>
    </div>

    @include('destinations.create-modal')
    @include('webhooks_buckets.edit-bucket-modal')
    @include('destinations.edit-modal')

    <script></script>

</x-main-layout>
