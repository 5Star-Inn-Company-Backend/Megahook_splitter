<x-app-layout>
    

    <link href="css/style.css" rel="stylesheet">
 
    <!-- Scripts -->

  <main id="main">

    

 

    <section id="pricing" class="pricing" style="padding-top: 5rem;">
                    <div class="container" data-aos="fade-up">

                        <div class="section-title">
                            <h2>Pricing</h2>
                            <p>You are not setup on an active subscription. Kindly select a subscription below to
                                continue with our services.</p>
                                
                        </div>

                        <div class="row">

                            @foreach ($plans as $plan)
                                <div class="col-lg-4 mb-2" data-aos="fade-up" data-aos-delay="100">
                                    <div class="box">
                                        <h3>{{ $plan->name }} Plan</h3>
                                        <h4><sup>₦</sup>{{ number_format($plan->price, 2) }}<span>per month</span></h4>
                                        <ul>
                                            @foreach (explode(',', $plan->description) as $description)
                                                <li><i class="fa fa-check"></i> {{ $description }}</li>
                                            @endforeach
                                        </ul>   
                                            <a href="{{route('register')}}" class="buy-btn">Get Started</a>
                                        
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </section><!-- End Pricing Section -->


</x-app-layout>