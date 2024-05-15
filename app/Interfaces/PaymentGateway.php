<?php

namespace App\Interfaces;

use App\Models\Payment;

interface PaymentGateway
{
    public function processPayment(array $paymentData);
    public function refundPayment($transactionId, $amount);
    public function verifyPayment(Payment $payment);
}
