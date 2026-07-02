<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$secret_key = $_ENV['PAYSTACK_SECRET_KEY'];

if (!isset($_GET['reference'])) {
    die('No reference supplied');
}

$reference = $_GET['reference'];

$url = "https://api.paystack.co/transaction/verify/" . rawurlencode($reference);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $secret_key",
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['data']['status'] === 'success') {
    echo "<h3>Payment Successful!</h3>";
    echo "Reference: " . $result['data']['reference'] . "<br>";
    echo "Amount: ₦" . $result['data']['amount'] / 100 . "<br>";
    echo "Email: " . $result['data']['customer']['email'];
} else {
    echo "<h3>Payment Failed or Invalid Reference</h3>";
}
