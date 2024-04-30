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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                </div>
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
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bucket-name" name="name"
                                    placeholder="Enter bucket name"/>
                                </div>
                            
                                <div class="form-group text-right">
                                    <input type="submit" class="btn w-25" id="submitBtn" style="background: #1bac91; color :#fff" value="save" />
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

    <script>
        $('#bucketFormId').on('submit', function(e){
            e.preventDefault();
            const bucketName = $('#bucket-name').val();

            if(bucketName =="" || bucketName == null){
                return;
            }

            // alert(bucketName);
        })
    </script>
</x-main-layout>


