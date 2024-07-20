<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Jobs\ActivatePlanJob;
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
        $showPricingModal = true;
       // dd($showPricingModal);
        //return rescue(function () {
            $payments = Payment::with('plan')->latest()->paginate(10);
            return view('payments.index', compact('showPricingModal', 'payments'));
       // }, 
        // function ($ex) {
        //     return redirect()->back()->with('error', $ex->getMessage());
        // });
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
        return rescue(function () use ($request) {
            $paymentData = $request->all();
            $result = $this->paymentService->processPayment($paymentData);
            if (filter_var($result, FILTER_VALIDATE_URL) === false) {
                return redirect()->back()->with('error', $result);
            } else {

                return redirect()->away($result);
            }
        }, function ($ex) {
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
        return rescue(function () use ($request) {
            $reference = $request->query('reference');
            $payment = Payment::where('user_id', auth()->user()->id)->where('reference', $reference)->first();
            $paymentResponse = $this->paymentService->verifyPayment($payment);

            if ($paymentResponse['data']['status'] == 'success' && $paymentResponse['status'] == true) {
                $payment->update(['status' => Payment::SUCCESS]);
                ActivatePlanJob::dispatch($payment);
                return view('payments.confirmation-page-success', compact('payment'));
            }

            $payment->update(['status' => Payment::FAILED]);
            return view('payments.confirmation-page-failed', compact('payment'));
        }, function (Exception $ex) use ($request) {
            \Log::info($ex->getMessage());
            $payment = Payment::where('user_id', auth()->user()->id)->where('reference', $request->reference)->first();
            $payment->update(['status' => Payment::FAILED]);
            return view('payments.confirmation-page-failed', compact('payment'));
        });
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
