<div class="modal fade" id="shippingModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <section id="pricing" class="pricing">
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
                                        <h4><sup>$</sup>{{ $plan->price }}<span>per month</span></h4>
                                        <ul>
                                            @foreach (explode(',', $plan->description) as $description)
                                                <li><i class="fa fa-check"></i> {{ $description }}</li>
                                            @endforeach
                                        </ul>
                                        <form action="{{ route('payments.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="amount"  value="{{$plan->price}}"/>
                                            <input type="hidden" name="type" value="App\Models\Plan" />
                                            <input type="hidden" name="type_id" value="{{$plan->id}}" />
                                            <input type="submit" value="Get Started" class="buy-btn">
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </section><!-- End Pricing Section -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
