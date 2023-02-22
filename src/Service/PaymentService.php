<?php


namespace App\Service;


use Stripe\PaymentIntent;

class PaymentService
{
    public function setAPI(float $prix) : PaymentIntent
    {
        \Stripe\Stripe::setApiKey('sk_test_51Mco2mCmQpXm4b5Y804cXBizL6i9TvJmyyAavOdwOuIgul9diNg0GzFQh4eTCKVv0s3uNNpVd3wVi1XXDyL4psOj00n8pXh4JI');
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $prix*100,
            'currency' => 'eur'
        ]);
        return $intent;
    }

}
