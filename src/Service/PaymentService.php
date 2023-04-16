<?php


namespace App\Service;


use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentService
{
    /**
     * @throws ApiErrorException
     */
    public function setAPI(float $prix) : PaymentIntent
    {
        Stripe::setApiKey('sk_test_51Mco2mCmQpXm4b5Y804cXBizL6i9TvJmyyAavOdwOuIgul9diNg0GzFQh4eTCKVv0s3uNNpVd3wVi1XXDyL4psOj00n8pXh4JI');
        return PaymentIntent::create([
            'amount' => $prix*100,
            'currency' => 'eur'
        ]);
    }

}
