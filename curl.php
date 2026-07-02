<?php

// curl => Fetch all countries
$url = "https://api.restcountries.com/countries/v5/codes.alpha_2/ca?pretty=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer rc_live_demo",
    "Cache-Control: no-cache",
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

$countries = json_decode($result);
print_r($countries);
curl_close($ch);
