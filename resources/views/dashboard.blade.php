<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="">
                        <ul class="nav nav-tabs float-left " id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="updateFilterText('Last 24 Hours')">Last 24 Hours</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="updateFilterText('Last 7 Days')">Last 7 Days</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick="updateFilterText('Last 30 Days')">Last 30 Days</a>
                            </li>
                        </ul>
                        <p class="float-right" id="filterText"></p>
                    </div>
                    <div style="float: none;clear: both;" class="mb-3"></div>
                   
                      
                    <div class="card">
                        <h5 class="card-header"><i class="fa fa-tachometer" aria-hidden="true"></i> Deliverability Summary
                        </h5>
                        <div class="card-body">
                            <div class="row m-1" style="height: 120px; text-align:center; display:flex; justify-content:space-between;">
                                <div class="col-md-2 pt-3" style="background: #4083be; color:#fff; border-radius:1rem">
                                    <p class="mb-4" style="font-size:35px"> {{$destination}}</p>
                                    <p>Destination</p>
                                </div>
                                <div class="col-md-2 pt-3" style=" background:#9cbfdd; color:#fff; border-radius:1rem">
                                    <p class="mb-4" style="font-size:35px">{{$webhooks}}</p>
                                    <p>Incoming Webhook</p>
                                </div>
                                <div class="col-md-2 pt-3" style=" background:#90EE90; color:#fff; border-radius:1rem">
                                    <p class="mb-4" style="font-size:35px">{{$successResponse}}</p>
                                    <p>Successfully Deliveries</p>
                                </div>
                                <div class="col-md-2 pt-3" style=" background:#7c8184; color:#fff; border-radius:1rem">
                                    <p class="mb-4" style="font-size:35px">{{$secondFailureResponse}}</p>
                                    <p>4xxx Failures</p>
                                </div>
                                <div class="col-md-2 pt-3" style=" background:#FF474C; color:#fff; border-radius:1rem">
                                    <p class="mb-4" style="font-size:35px">{{$failureResponse}}</p>
                                    <p>5xxx Failures</p>
                                </div>
                                 
                            </div>
                        </div>
                    </div>


                    <div class="card mt-5">
                        <h5 class="card-header"><i class="fa fa-bar-chart" aria-hidden="true"></i> Delivery Statistics
                        </h5>
                        <div class="card-body">
                            <div class="row m-1" style="height: 120px; text-align:center;">
                                <div style="width: 50%">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <h5 class="card-header"><i class="fa fa-refresh" aria-hidden="true"></i> In Process Hook</h5>
                        <div class="card-body">
                            <div class="row m-1" style="height: 120px; text-align:center;">
                                <div class="col-md-6">
                                    <p class="font-weight-bold" style="font-size:35px">0</p>
                                    <p>Queued for Delivery</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="font-weight-bold" style="font-size:35px">0</p>
                                    <p>Pending Resend/Retry</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if ($showPricingModal)
                        @include('modal')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
