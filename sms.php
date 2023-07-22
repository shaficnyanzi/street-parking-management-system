<?php
require_once 'vendor/autoload.php'; // Path to autoload.php from the Africa's Talking SDK

use AfricasTalking\SDK\AfricasTalking;

// Initialize the SDK
$username = 'groupb';
$apiKey = 'e0a75bac69431f67c0830f2a3709672a5bfb02daff8f6a53';
$AT = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms = $AT->sms();

// Set the message parameters
$options = [
    'to' => '+256752136621',  // Replace with recipient's phone number
    'message' => 'Hello user,kindly remainding that your time has elapsed,you can extend your parking by visiting parkinga management system.Thank you!',  // Replace with your message
];

// Send the SMS
try {
    $result = $sms->send($options);
    print_r($result);  // Output the API response
    // Redirect to home.php
    header("Location: attendant_portal.php");
    exit();
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
