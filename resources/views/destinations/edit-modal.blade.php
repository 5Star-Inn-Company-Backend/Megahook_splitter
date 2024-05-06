<div class="modal fade mt-2" id="editDestination" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">

                <section id="pricing" class="pricing">
                    <div class="container mt-5" data-aos="fade-up">
                        <h1 style="color:#1bac91; font-size:25px;" class="font-weight-bold">Update Destination
                        </h1>
                        <P class="text-lg font-weight-bold">Destination Setup</P>


                        <form id="editDestinationFormId" class="mt-2">
                            <small>Fill out the details below to setup a new destination for the input
                                specified.</small>
                            <p id="edit-destination-error" class="text-danger p-2" style="display: none"></p>

                            <input type="hidden" id="edit-destination-id" />
                            <div class="form-group">
                                <label for="destination-label">Destination Name</label>
                                <input type="text" class="form-control" id="edit-destination-name"
                                    name="destination_name" placeholder="Enter a label for destination"
                                     />
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Endpoint URL</label>
                                <input type="text" class="form-control" id="edit-endpoint-url" name="endpoint_url"
                                    placeholder="Endpoint Url" />
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Retry Policies</label>
                                <select name="retry_policies" class="form-control" id="edit-retry-policies">
                                    <option value="" selected disabled></option>
                                    <option value="no Auto Retries">No AutoRetries</option>
                                    <option value="linear">Linear</option>
                                    <option value="exponential backoff">Exponential Backoff</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="destination-label">Authentication Type</label>
                                <select name="authentication_type" class="form-control" id="edit-authentication-type">
                                    <option value="" selected disabled></option>
                                    <option value="passthrough">PassThrough</option>
                                    <option value="basic authentication">Basic Authentication</option>
                                    <option value="token">Token</option>
                                    <option value="hmac sha1 hash">Hmac Sha1 Hash</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Alert on Failure</label>
                                <input type="text" class="form-control" id="edit-emails" name="emails" placeholder="Email Addresses" />
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn w-25" id="editSubmitDestBtn"
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
    let editWebhookId = '';
   

    function editDestination(webhook_id, destination) {
        editWebhookId = webhook_id;
       
        $('#edit-destination-id').val(destination.id);
        $('#edit-destination-name').val(destination.destination_name);
        $('#edit-endpoint-url').val(destination.endpoint_url);
        $('#edit-retry-policies').val(destination.retry_policy);
        $('#edit-authentication-type').val(destination.authentication_type);
        $('#edit-emails').val(destination.alert_on_failure);
    }

    $('#editDestinationFormId').on('submit', function(e) {

        e.preventDefault();
        const editDestinationErrors = [];

        $('#edit-destination-name').on('keydown', function() {
            $('#edit-destination-error').text('').hide();
        });


        const editDestinationId = $('#edit-destination-id').val();
        const editDestinationName = $('#edit-destination-name').val();
        const editEndpointUrl = $('#edit-endpoint-url').val();
        const editRetryPolicies = $('#edit-retry-policies').val();
        const editAuthenticationType = $('#edit-authentication-type').val();
        const editEmails = $('#edit-emails').val();


        if (editDestinationName.trim() == "" || editDestinationName.trim() == null) {
            destinationErrors.push('kindly Enter a valid destination name');
        }

        if (editEndpointUrl.trim() == "" || editEndpointUrl.trim() == null) {
            destinationErrors.push('kindly Enter a valid endpoints');
        }

        if (editRetryPolicies == "" || editRetryPolicies == null) {
            destinationErrors.push('kindly select a valid retry policy');
        }

        if (editAuthenticationType == "" || editAuthenticationType == null) {
            destinationErrors.push('kindly select a valid authentication type');
        }




        if (editDestinationErrors.length !== 0) {

            editDestinationErrors.forEach(error => {
                let editDisplayError = `<li>${error}</li>`;
                $('#edit-destination-error').append(editDisplayError).show();
                console.log(error)
            });

            return;
        }

        const editLoadingspinner =
            ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

        const editSubmitDestBtn = $('#editSubmitDestBtn');
        const editSubmitDestBtnText = 'Update';

        editSubmitDestBtn.html(editLoadingspinner).prop('disabled', true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        console.log(editDestinationId);
        $.ajax({
            type: "PUT",
            url: `/destinations/${editDestinationId}/webhooks/${editWebhookId}`,
            data: {
                destination_name: editDestinationName,
                endpoint_url: editEndpointUrl,
                retry_policy: editRetryPolicies,
                authentication_type: editAuthenticationType,
                alert_on_failure: editEmails
            },
            dataType: 'json',
            success: function() {
                window.location.reload();
                editSubmitDestBtn.text(editSubmitDestBtnText).prop('disabled', false);

            },
            error: function() {
                editSubmitDestBtn.text(editSubmitDestBtnText).prop('disabled', false);
                $('#edit-destination-error').text('');
                $('#edit-destination-error').append(`<li>Failed to save destination</li>`).show();
            }

        });
    })
</script>
