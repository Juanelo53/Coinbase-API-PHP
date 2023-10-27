<?php 

use JuaneloCoinbase\Coinbase\Charges\CoinbaseCharges;

require_once "vendor/autoload.php";

header('Content-type: application/json');

$charges = new CoinbaseCharges;

// List all Charges 
echo json_encode(
    $charges->listAllCharges()
);

// Create a Charges with porams required
// Read more: https://docs.cloud.coinbase.com/commerce/reference/createcharge
echo json_encode(
    $charges->createCharge([
        'name' => 'Create Charge',
        'description' => 'Example for create a charge',
        'pricing_type' => 'fixed_price', // Fixed Price with Crypto
        'local_price' => [
            'amount' => '50.00', // 50 USD
            'currency' => 'USD'
        ],
        'metadata' => [
            'customer_id' => uniqid(),
            'customer_name' => 'Juanelo'
        ]
    ])
);

// Show Charge
echo json_encode(
    $charges->showCharge('CHARGE_ID') // Order ID 
);

// Cancel new Charge
echo json_encode(
    $charges->cancelCharge('CHARGE_ID') // Order ID 
);

// Resolve charge with refund and cancel or other
echo json_encode(
    $charges->resolveCharge('CHARGE_ID') // Order ID 
);

// View status code of the payment.
// Read more in : https://docs.cloud.coinbase.com/commerce/docs/payment-status
echo json_encode(
    $charges->viewStatusCharge('CHARGE_ID')
);