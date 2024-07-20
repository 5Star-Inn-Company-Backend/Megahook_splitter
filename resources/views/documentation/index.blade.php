<x-app-layout>
    <style>
      .documentation-container {
  max-width: 80rem;
  margin: 4rem auto;
  padding: 2rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 0.5rem;
  box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
}

.documentation-header {
 background-color: #333;
  color: #fff;
  padding: 1rem;
  border-bottom: 1px solid #444;
}

.documentation-title {
  font-size: 2rem;
  font-weight: bold;
}

.documentation-content {
  padding: 2rem;
}

.documentation-section {
  margin-bottom: 4rem;
}

.documentation-section-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1rem;
}

.documentation-description {
  color: #666;
  margin-bottom: 2rem;
}

.documentation-code-block {
  background-color: #f7f7f7;
  border: 1px solid #ddd;
  padding: 1rem;
  border-radius: 0.5rem;
}

.documentation-code-block code {
  font-size: 1rem;
  color: #333;
}


.documentation-footer {
  background-color: #333;
  color: #fff;
  padding: 1rem;
  border-top: 1px solid #444;
  text-align: center;
}

.documentation-footer-text {
  font-size: 1rem;
}

    </style>
 

  <main id="main">

    

   
  <section class="documentation-container">
  <header class="documentation-header">
    <h1 class="documentation-title">Documentation</h1>
  </header>
  <div class="documentation-content">
    <section class="documentation-section">
      <h2 class="documentation-section-title">Getting Started</h2>
      <p class="documentation-description">Our webhook relay enables you to manage and gain insights into the webhooks your application uses. It also allows multiple applications to utilize a single provider. Getting started is straightforward, and our platform is compatible with any service that provides webhooks.
      We’ll guide you through the basic setup for relaying your webhooks via our system</p>
      <code class="documentation-code-block">Step 1: Understand the System
      </code>
      <ul class="mt-6 mb-6">
        <li><strong> Bucket:</strong> A container that provides a URL to give to the service provider sending you webhooks.</li>
        <li><strong> Destination:</strong> The name of your application along with its webhook URL</li>
      </ul>

      <code class="documentation-code-block">Step 2: Create a Bucket
      </code>
      <ul class="mt-6 mb-6">
        <li>Click on "Add Bucket" and fill out the form</li>  
      </ul>

      <code class="documentation-code-block">Step 3: Create a Destination
      </code>
      <ul class="mt-6 mb-6">
        <li>After creating a bucket, click the "New Destination" button to configure where the webhooks should be forwarded. Simply add the endpoint title and destination URL. More advanced options are covered in other sections.</li>  
      </ul>

      <code class="documentation-code-block">Step 4: Update Webhook Provider Settings
      </code>
      <ul class="mt-6 mb-6">
        <li>Now that your input and destination are set up in your webhooks.io account, you need to inform your service provider to start sending webhooks to your account. Log in to your service provider account, navigate to the webhooks settings, paste your incoming endpoint URL into the provider's endpoint field, and save the settings.
        Your service provider will now send webhooks to your account, which will then relay them to the destination(s) created under the bucket.
        That's it! Now that your webhook requests are flowing through our platform, you can:
        </li> 
        <ol>
          <li>1. View webhook insights, including the ability to easily identify and resend failures.
          </li>
          <li>2. Transform request security.</li>
          <li>3. Pause certain destinations for server upgrades or maintenance</li>
        </ol> 
        <i>If you encounter any issues, we're here to help!</i>
      </ul>

      <h2 class="documentation-section-title">Buckets</h2>
      <p class="documentation-description">Buckets help you organize and segment different types of webhooks you consume. For example, you might want to segment webhooks by project or function.</p>
      
      <h3 class="documentation-section-title text-xl">Creating Buckets</h3>
      <p class="documentation-description">Create a new bucket by hovering over "Webhook Buckets" in the top navigation and selecting "Add Bucket." Fill out the forms and click save. You can now begin adding destinations to the bucket.</p>
      <h4 class="text-xl font-2xl">Properties</h4>
      <ul class="pb-4 pl-6">
          <li>⦁	Name: The name you provide for the bucket to help remember what data flows into it.</li>
          <li>⦁	Authentication Type: How the request is authenticated when it enters our platform. Unauthenticated requests return a 403 status code.</li>
          <li>⦁	Response Code: The HTTP response code returned to the calling system upon a successfully authenticated request.</li>
          <li>⦁	Response Content Type: The type of response content returned to the calling system.</li>
          <li>⦁	Response Content: The actual content returned to the calling system.</li>
          
      </ul>

      <h4 class="text-xl">Renaming Buckets</h4>
      <p class="documentation-description">To rename a bucket, click on the "Edit" button, complete the form, and submit.
      </p>

      <h4 class="text-xl">Deleting a Bucket</h4>
      <p class="documentation-description">You can delete a bucket by clicking on the red "Delete" button.
      </p>

      <h2 class="documentation-section-title">Destinations</h2>
      <p class="documentation-description">Destinations are where you want the webhook payloads to be delivered. Each bucket can have multiple destinations, allowing you to fan-out webhook requests to multiple systems.
      </p>

      <h4 class="text-xl">Creating a Destination
      </h4>
      <p class="documentation-description">To create a destination, click on the bucket you want to associate the destination with, then click "New Destination." Complete the form and click save.

      </p>

      <h4 class="text-xl">Updating a Destination
      </h4>
        <p class="documentation-description">To update a destination, click on "Webhook Buckets" from the top navigation, select the bucket associated with the destination, and click the name of the bucket. Then, click "Edit Destination" to load the edit form.

        </p>

      <h4 class="text-xl">Deleting a Destination  </h4>
      <p class="documentation-description"><strong> Caution:</strong> This operation cannot be undone! Deleting a destination will also delete all associated request data. To delete a destination, click on the red "Delete" button.

      </p>

      <h4 class="text-xl font-2xl">Destination Properties</h4>
      <ul class="pb-4 pl-6">
          <li>⦁	Destination Name: The name to help remember the target the data is flowing to.</li>
          <li>⦁	Endpoint URL: The URL where the data should be sent. This can be a URL within your application or a third-party integration.</li>
          <li>⦁	Retry Policy: Customize how failures are handled and retried. See the Retry Policy page for details.</li>
          <li>⦁	Authentication Type: Add specific authentication parameters to the request. This field allows you to add the authentication for requests sent from our system. See the Authentication Types page for details.</li>
          <li>⦁	Alert On Failure: A list of emails to notify if a webhook request fails after exhausting all retry policies.</li>
          
      </ul>

    <h2 class="documentation-section-title">Authentication Types</h2>
    <p class="documentation-description">When a message arrives, we can check if it has the proper authentication. If it fails authentication, a 403 Forbidden response code is returned to the originating system.
      For outgoing messages to the destination endpoint URL, you can assign custom authentication parameters so the destination can authenticate the request. This is useful if you want to write a single authentication module for your system.
    </p>

    <h4 class="text-xl font-2xl pb-3">Supported Authentication Schemes</h4>
    <h5><strong>Buckets</strong> </h5>
      <ul class="pl-6 mb-2">
          <li>⦁	No Authentication</li>
           <li>⦁ Basic Authentication</li>
           <li>⦁ Token</li>
           <li>⦁ HMAC SHA1 Hash</li>
           <li>⦁ HMAC SHA256 Hash</li>
      </ul>

    <h5><strong>Destinations</strong></h5>
      <ul class="pl-6">
          <li>⦁	Passthrough</li>
           <li>⦁ Basic Authentication</li>
           <li>⦁ Token</li>
           <li>⦁ HMAC SHA1 Hash</li>
           <li>⦁ HMAC SHA256 Hash</li>
      </ul>

      <ul>
     
</ul>

    </section>
     


        </div>

      </div>
    </section><!-- End Steps Section -->


</x-app-layout>