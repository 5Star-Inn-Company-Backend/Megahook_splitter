<x-app-layout>
    
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1 style="color: #22d8b6">WEBHOOK PROXY & PROVIDER PLATFORM</h1>
      <h6>Making webhooks reliable, scalable, and flexible for end-users and application providers.</h6>
      <a href="#about" class="btn-get-started scrollto">Webhook Proxy Services</a>
      <a href="#about" class="btn-get-started scrollto">SaaS Provider Platform</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-xl-6 col-lg-7" data-aos="fade-right">
            <img src="Maxim/assets/img/feature-5.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-xl-6 col-lg-5 pt-5 pt-lg-0">
            <h4 data-aos="fade-up">Proxy all of your webhooks through one dependable service.</h4>
            <p data-aos="fade-up">
              A service built for dependability and speed.
            </p>
            <div class="icon-box" data-aos="fade-up">
              <i class="bx bx-receipt"></i>
              <h5>Quick Search</h5>
              <p>Drill into requests and troubleshoot failures fast and reliably.</p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-cube-alt"></i>
              <h5> Fully Hosted and Secure No software to install. Fully hosted. Data encrypted from end to end and at rest.</h5>
              <p>No software to install. Fully hosted. Data encrypted from end to end and at rest.</p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-cube-alt"></i>
              <h5>Detailed Analytics</h5>
              <p>View trends and metrics on deliverability. </p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Steps Section ======= -->
    <section id="steps" class="steps section-bg">
      <div class="container">
        <div class="row no-gutters">

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in">
            <span><i class="fa fa-book"></i></span>
            <h4>Proxy Service for consumers. Platform for providers.</h4>
            <p>For webhook consumers, we provide an easy and reliable proxy service packed with features for making webhooks more dependable and useful.
               For providers, we offer a drop-in module and proxy service that adds a robust webhook engine in your application - allowing you to focus on your core competency.</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="100">
            <h4>Proxy Relay Service</h4>
            <p>For webhook consumers, proxy all of your webhook traffic through our service in less than 5 minutes. Immediately gain insight and dependability for all of your requests.
               The proxy service offers all features including; data transformations, filtering, and multiple destination endpoints..</p>
          </div>

          <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" data-aos-delay="200">
            <h4>Provider Platform</h4>
            <p>For webhook providers, take the headache out of building webhook delivery into your application. With our provider platform and client libraries, you can have a full webhook implementation, backed by a scalable infrastructure, up and running in only a few lines of code.
               Stop worrying about webhooks and get back to focusing on your application.</p>
          </div>

        </div>

      </div>
    </section><!-- End Steps Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                  <h4>Advanced Data Transformations & Filtering</h4>
                  <p>Use JavaScript syntax to quickly make programatic changes to payloads and even filter requests based on incoming payload data.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                  <h4>Send to Multiple Destinations</h4>
                  <p>Send a single webhook request to one or more destinations.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                  <h4>Fast</h4>
                  <p>Webhook producers can expect sub-second response times for all deliveries.</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-7 ml-auto" data-aos="fade-left">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <figure>
                  <img src="Maxim/assets/img/features-1.png" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-2">
                <figure>
                  <img src="Maxim/assets/img/features-2.png" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-4">
                <figure>
                  <img src="Maxim/assets/img/features-3.png" alt="" class="img-fluid">
                </figure>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg mb-4">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Ready to get started?</h2>
          <p>All accounts come with a 30 day money back guarantee. No questions, no hassle!.</p>
        </div>

        <div class="row" style="display: flex; justify-content:center">
          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="fade-up">
              <a href="{{route('register')}}" class="btn-get-started-now scrollto">Get Started now</a>
            </div>

          <div class="col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
              <a href="/pricing" class="btn-see-pricing scrollto">See Pricing</a>
            </div>
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

</x-app-layout>