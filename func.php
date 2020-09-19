
<?php

// https://hackzurich-api.migros.ch
//https://lemon-pebble-032061603.azurestaticapps.net/data
$url = "https://hackzurich-api.migros.ch";
$username = "hackzurich2020";
$password = "uhSyJ08KexKn4ZFS";



function get_product($get) //products?search='.$_GET['search']
{
$url = "https://hackzurich-api.migros.ch";
$username = "hackzurich2020";
$password = "uhSyJ08KexKn4ZFS";
$host = 'https://hackzurich-api.migros.ch/'.$get;
//echo 'HOST: '.$host.' </br>';	
$headers = array('Content-Type:application/json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$host);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
$products = curl_exec($ch);
curl_close($ch); 
 
//echo($result);
$productsarray = json_decode($products, true);


//echo '<pre>'; print_r($products); echo '</pre>';

return $productsarray;



}


?>