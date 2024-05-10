<?php

namespace App\Services;

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
}
