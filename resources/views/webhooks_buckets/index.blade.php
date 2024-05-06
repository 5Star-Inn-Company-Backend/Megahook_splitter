<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Webhook Bucket') }}
            </h2>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <button style="background: #1bac91; color:#fff; padding: 5px; border-radius:5px; cursor: pointer;"
                    data-toggle="modal" data-target="#createBucket">
                    {{ __('Add Bucket') }} <i class="fa fa-plus m-1" style="color: #fff"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($webhookBuckets as $webhookBucket)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                    <div class="p-6 text-gray-900">
                        <div style="display: flex; justify-content:space-between">
                            <li>
                                <a
                                    href="{{ route('webhook-buckets.show', $webhookBucket->id) }}" class="font-weight-bold" style="font-size: 16px;" >{{ ucwords($webhookBucket->name) }}</a>
                            </li>

                            <div>
                                <a href="{{ route('webhook.create', $webhookBucket->id) }}"
                                    class="btn btn-primary "> create new input <i class="fa fa-plus"></i></a>
                                <button type="button" class="btn btn-warning "
                                    onclick="editBucketBtn({{ $webhookBucket }})" style="cursor:pointer"
                                    data-toggle="modal" data-target="#editBucket" id="edit-bucket-btn">
                                    edit bucket <i class="fa fa-pen"></i>
                                </button>
                            </div>
                        </div>
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


    @include('webhooks_buckets.edit-bucket-modal')

    <script>
        $('#bucketFormId').on('submit', function(e) {
            e.preventDefault();

            $('#bucket-name').on('keydown', function() {
                $('#error').text('').hide();
            });

            const bucketName = $('#bucket-name').val();

            if (bucketName.trim() == "" || bucketName.trim() == null) {
                $('#error').text('kindly Enter a valid bucket name').show();
                return;
            }

            const spinner = ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Saving...`;

            const submitBtn = $('#submitBtn');
            const submitBtnText = 'Save';

            submitBtn.html(spinner).prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/webhook-buckets",
                data: {
                    name: bucketName
                },
                dataType: 'json',
                success: function() {
                    window.location.reload();
                    submitBtn.text(submitBtnText).prop('disabled', false);

                },
                error: function() {
                    submitBtn.text(submitBtnText).prop('disabled', false);
                    $('#error').text('failed to save bucket name').show();
                }

            });
        })

       
    </script>

</x-main-layout>
