<div class="modal fade" id="editBucket" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">

                    <section id="pricing" class="pricing">
                        <div class="container" data-aos="fade-up">
                            <h3 style="color:#1bac91" class="font-weight-bold">Edit Bucket</h3>
                            <label for="bucket name"> Enter a name for your bucket and save</label>
                            <form action="" method="post" id="edit-bucket-form-id">
                                <p id="edit-error" class="text-danger p-2" style="display: none"></p>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="edit-bucket-name" name="name"
                                        placeholder="Enter bucket name"/>
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn w-25" id="edit-submit-btn"
                                        style="background: #1bac91; color :#fff">
                                        Update

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

    <script>
            function editBucketBtn(webhookBucket) {
            $('#edit-bucket-name').val('');
            $('#edit-error').text('').hide();
            console.log(webhookBucket);
            $('#edit-bucket-name').val(webhookBucket.name);

        $('#edit-bucket-form-id').on('submit', function(e) {
            e.preventDefault();

            $('#edit-bucket-name').on('keydown', function() {
                $('#edit-error').text('').hide();
            });

            const editBucketName = $('#edit-bucket-name').val();

            if (editBucketName.trim() == "" || editBucketName.trim() == null) {
                $('#edit-error').text('kindly Enter a valid bucket name').show();
                return;
            }

            const spinner = ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

            const updateSubmitBtn = $('#edit-submit-btn');
            const updateSubmitBtnText = 'Update';

            updateSubmitBtn.html(spinner).prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: `/webhook-buckets/${webhookBucket.id}`,
                data: {
                    name: editBucketName
                },
                dataType: 'json',
                success: function() {
                    window.location.reload();
                    updateSubmitBtn.text(updateSubmitBtnText).prop('disabled', false);

                },
                error: function() {
                    updateSubmitBtn.text(updateSubmitBtnText).prop('disabled', false);
                    $('#error').text('failed to save bucket name').show();
                }

            });
        })
    }
    </script>