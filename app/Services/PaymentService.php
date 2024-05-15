<?php

namespace App\Services;

use App\Models\Payment;
use App\Interfaces\PaymentGateway;

class PaymentService
{
    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway) {
        $this->paymentGateway = $paymentGateway;
    }


    public function processPayment($amount) {
        return $this->paymentGateway->processPayment($amount);
    }

    public function refundPayment($transactionId, $amount) {
        return $this->paymentGateway->refundPayment($transactionId, $amount);
    }

    public function verifyPayment(Payment $payement){
        return $this->paymentGateway->verifyPayment($payement);
    }
}
