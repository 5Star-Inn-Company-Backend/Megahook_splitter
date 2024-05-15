<x-main-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment Histories') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-1">
                <div class="max-w-7xl text-right p-2">
                    <table class="table table-striped">
                        <thead>
                            <tr class="font-weight-bold">
                                <th scope="col">#</th>
                                <th>Payment Reference</th>
                                <th>Payment Type</th>
                                <th>Price</th>
                                <th>Amount Paid</th>
                                <th>Payment Gateway</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$payment->reference}}</td>
                                    <td>{{($payment->type  == 'App\Models\Plan' )? 'Plan' : ''}}</td>
                                    <td>{{$payment->plan?->name}} - {{$payment->plan?->price}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->payment_gateway_name}}</td>
                                    @if($payment->status == 'success')
                                    <td class="badge badge-success m-1">{{$payment->status}}</td>
                                    @elseif ($payment->status == 'pending')
                                    <td class="badge badge-warning m-1">{{$payment->status}}</td>
                                    @else
                                    <td class="badge badge-danger m-1">{{$payment->status}}</td>
                                    @endif
                                    <td>{{$payment->created_at}}</td>
                                </tr>
                            @empty
                                <p>No payment made yet!</p>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">{{ $payments->links() }}</td>
                            </tr>
                        <tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-main-layout>
