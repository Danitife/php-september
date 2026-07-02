<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$secret_key = $_ENV['PAYSTACK_SECRET_KEY'];

$email = "dan@gmail.com";
$amount = 5000 * 100; // Paystack uses kobo

$url = "https://api.paystack.co/transaction/initialize";
$fields = [
    'email' => $email,
    'amount' => $amount,
    'callback_url' => 'http://localhost:8004/callback.php'
];

$fields_string = http_build_query($fields);

try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key",
        "Cache-Control: no-cache",
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if ($response['status']) {
        header("Location: " . $response['data']['authorization_url']);
        exit;
    } else {
        echo "Error initializing payment.";
    }
} catch (\Exception $e) {
    //throw $th;
    echo $e->getMessage();
}
