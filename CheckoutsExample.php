<?php

use JuaneloCoinbase\Coinbase\Checkouts\CoinbaseCheckouts;

require_once "vendor/autoload.php";

header('Content-type: application/json');

$checkouts = new CoinbaseCheckouts;


// List all Checkouts 
 echo json_encode(
     $checkouts->listAllCheckouts()
 );

// Create a Checkout 
echo json_encode(
    $checkouts->createCheckout([
        'name' => 'Example create Checkout',
        'description' => 'Create Checkout',
        'requested_info' => [
            'asdasdasd' // The info pararmeter is incorrect. Please read more in: https://docs.cloud.coinbase.com/commerce/reference/createcheckout
        ],
        'pricing_type' => 'fixed_price', // Fixed Price with Crypto
        'local_price' => [
            'amount' => '50.00', // 50 USD
            'currency' => 'USD'
        ],
    ])
);

// Show Checkout
echo json_encode(
    $checkouts->showCheckout('CHECKOUT_ID')
);

// Update Checkout
echo json_encode(
    $checkouts->updateCheckout('CHECKOUT_ID')
);

// Delete Checkout
echo json_encode(
    $checkouts->deleteCheckout('CHECKOUT_ID')
);