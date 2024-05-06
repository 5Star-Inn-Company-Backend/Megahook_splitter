<div class="modal fade mt-2" id="createDestination" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">

                <section id="pricing" class="pricing">
                    <div class="container mt-5" data-aos="fade-up">
                        <h1 style="color:#1bac91; font-size:25px;" class="font-weight-bold">Configure New Destination
                        </h1>
                        <P class="text-lg font-weight-bold">Destination Setup</P>


                        <form id="createDestinationFormId" class="mt-2">
                            <small>Fill out the details below to setup a new destination for the input
                                specified.</small>
                            <p id="destination-error" class="text-danger p-2" style="display: none"></p>

                            <div class="form-group">
                                <label for="destination-label">Destination Name</label>
                                <input type="text" class="form-control" id="destination-name" name="destination_name"
                                    placeholder="Enter a label for destination" />
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Endpoint URL</label>
                                <input type="text" class="form-control" id="endpoint-url" name="endpoint_url"
                                    placeholder="Endpoint Url" />
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Retry Policies</label>
                                <select name="retry_policies" class="form-control" id="retry-policies">
                                    <option value="" selected disabled></option>
                                    <option value="no Auto Retries">No Auto Retries</option>
                                    <option value="linear">Linear</option>
                                    <option value="exponential backoff">Exponential Backoff</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="destination-label">Authentication Type</label>
                                <select name="authentication_type" class="form-control" id="authentication-type">
                                    <option value="" selected disabled></option>
                                    <option value="passthrough">PassThrough</option>
                                    <option value="basic authentication">Basic Authentication</option>
                                    <option value="token">Token</option>
                                    <option value="hmac sha1 hash">Hmac Sha1 Hash</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="destination-label">Alert on Failure</label>
                                <input type="text" class="form-control" id="emails" name="emails"
                                    placeholder="Email Addresses" />
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn w-25" id="submitDestBtn"
                                    style="background: #1bac91; color :#fff">
                                    Save
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

let webhookId = '';
function createNewDestination(webhook_id){
    webhookId = webhook_id;
}

    $('#createDestinationFormId').on('submit', function(e) {
        e.preventDefault();
        const destinationErrors = [];
    
        $('#destination-name').on('keydown', function() {
            $('#destination-error').text('').hide();
        });

        const destinationName = $('#destination-name').val();
        const endpointUrl = $('#endpoint-url').val();
        const retryPolicies = $('#retry-policies').val();
        const authenticationType = $('#authentication-type').val();
        const emails = $('#emails').val();


        if (destinationName.trim() == "" || destinationName.trim() == null) {
            destinationErrors.push('kindly Enter a valid destination name');
        }

        if (endpointUrl.trim() == "" || endpointUrl.trim() == null) {
            destinationErrors.push('kindly Enter a valid endpoints');
        }

        if (retryPolicies == "" || retryPolicies  == null) {
            destinationErrors.push('kindly select a valid retry policy');
        }

        if (authenticationType == "" || authenticationType == null) {
            destinationErrors.push('kindly select a valid authentication type');
        }



        if (destinationErrors.length !== 0) {

            destinationErrors.forEach(error => {
                let displayError = `<li>${error}</li>`;
                $('#destination-error').append(displayError).show();
                console.log(error)
            });

            return;
        }

        const loadingspinner =
            ` <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

        const submitDestBtn = $('#submitDestBtn');
        const submitDestBtnText = 'Save';

        submitDestBtn.html(loadingspinner).prop('disabled', true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: `/destinations/webhooks/${webhookId}`,
            data: {
                destination_name : destinationName,
                endpoint_url : endpointUrl,
                retry_policy : retryPolicies,
                authentication_type : authenticationType,
                alert_on_failure : emails
            },
            dataType: 'json',
            success: function() {
                window.location.reload();
                submitDestBtn.text(submitDestBtnText).prop('disabled', false);

            },
            error: function() {
                submitDestBtn.text(submitDestBtnText).prop('disabled', false);
                $('#destination-error').text('');
                $('#destination-error').append(`<li>Failed to save destination</li>`).show();
            }

        });
    })
</script>
