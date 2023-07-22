<?php
// Set your secret key
$secret_key = 'FLWSECK_TEST-202f1e7ee110295e1dc5424ee9b44a12-X';

// Set the payment parameters
$amount = 5000; // Amount to charge in the smallest currency unit (e.g., kobo for NGN)
$currency = 'NGN'; // Currency code (e.g., NGN for Nigerian Naira)
$redirect_url = 'https://example.com/payment_success'; // URL to redirect after payment

// Set the transaction reference
$transaction_reference = uniqid();

// Prepare the payload
$payload = array(
    'amount' => $amount,
    'currency' => $currency,
    'tx_ref' => $transaction_reference,
    'redirect_url' => $redirect_url,
    // Add any additional parameters as needed
);

// Set the API endpoint
$endpoint = 'https://api.flutterwave.com/v3/payments';

// Set the request headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $secret_key,
);

// Send the request to Flutterwave API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Process the response
$result = json_decode($response, true);

// Check if the request was successful
if ($result['status'] === 'success') {
    // Get the payment URL
    $payment_url = $result['data']['link'];

    // Redirect the user to the payment page
    header('Location: ' . $payment_url);
    exit;
} else {
    // Handle the error
    $error_message = $result['message'];
    // Display or log the error message
    echo 'Payment initiation failed: ' . $error_message;
}
?>
