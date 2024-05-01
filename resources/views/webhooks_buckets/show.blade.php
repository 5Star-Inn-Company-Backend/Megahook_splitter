<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook Bucket') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                <div class="p-6 text-gray-900">
                    <div class="d-flex" style="justify-content: space-between">
                        <h1 class="font-weight-bold" style="font-size:20px">{{ $webhookBucket->name }}</h1>
                        <div>
                            <a href="{{ route('webhook.create', $webhookBucket->id) }}" id="something"
                                class="btn btn-primary text-xs">create new input <i class="fa fa-plus"></i></a>
                            <a href="" class="btn btn-warning text-xs">edit bucket <i class="fa fa-pen"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <!-- The First FAQ -->
                @foreach ($webhookBucket->webhooks as $webhook)
                    <details class="bg-gray-300 open:bg-amber-200 duration-300 my-1">
                        <summary class="bg-inherit px-5 py-3 text-lg cursor-pointer">{{$webhook->input_name}}
                        </summary>
                        <div class="bg-white px-5 py-3 border border-gray-300 text-sm font-light">
                            <div>
                                <a href="" class="btn btn-info text-xs">new destination<i class="fa fa-plus"></i></a>
                                <a href="" class="btn btn-secondary text-xs"> edit<i class="fa fa-pen"></i></a>
                            </div>
                        </div>
                    </details>
                @endforeach

            </div>
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

                </div>
            </div>
        </div>
    </div>

    <script></script>
</x-main-layout>
