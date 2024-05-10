<?php

namespace App\Interfaces;

interface PaymentGateway
{
    public function processPayment(array $paymentData);
    public function refundPayment($transactionId, $amount);
}
