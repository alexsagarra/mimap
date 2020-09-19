<h1>mapi</h1>
</br>

<?php
// https://hackzurich-api.migros.ch
//https://lemon-pebble-032061603.azurestaticapps.net/data
$url = "https://hackzurich-api.migros.ch";
$username = "hackzurich2020";
$password = "uhSyJ08KexKn4ZFS";

$product_api = "products";

$host = "https://hackzurich-api.migros.ch/products";

$headers = array(
    'Content-Type:application/json',
    'Authorization: Basic '. base64_encode("username:password") // <---
);


$ch = curl_init($host);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$return = curl_exec($ch);
curl_close($ch);

print($return);

//$jsonArrayResponse - json_decode($return);
?>