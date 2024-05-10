<?php

namespace App\Http\Controllers;

use App\Jobs\ActivatePlanJob;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return rescue(function () use($request) {
            $paymentData = $request->all();
            $result = $this->paymentService->processPayment($paymentData);
            if (filter_var($result, FILTER_VALIDATE_URL) === false) {
                return redirect()->back()->with('error', $result);
            } else {

                return redirect()->away($result);
            }
        }, function ($ex){
            return redirect()->back()->with('error', $ex->getMessage());
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Confirm Payment
     */
    public function confirmation(Request $request)
    {
        $reference = $request->query('reference');
        $payment = Payment::where('user_id', auth()->user()->id)->where('reference', $reference)->first();
        $payment->update(['status' => Payment::SUCCESS]);

        return view('payments.confirmation-page', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
