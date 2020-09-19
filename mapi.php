<?php

if(isset($_GET['search'])) { $search = $_GET['search'];} else {$search = ''; }

?>

<html>
<body>

<h1>m-api</h1>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">home</a> | 
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">produkte</a> | 
<a href="<?php echo $_SERVER['PHP_SELF']; ?>">artikel</a> | 
</br></br></br>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
Search: <input type="text" name="search" value="<?=$search?>"><br>
<input type="submit" value="search">
</form>




<?php
if(isset($_GET['search'])) {


// https://hackzurich-api.migros.ch
//https://lemon-pebble-032061603.azurestaticapps.net/data
$url = "https://hackzurich-api.migros.ch";
$username = "hackzurich2020";
$password = "uhSyJ08KexKn4ZFS";

$product_api = "products";

$host = 'https://hackzurich-api.migros.ch/products?search='.$_GET['search'];

$headers = array(
    'Content-Type:application/json'
);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$host);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$products = curl_exec($ch);
curl_close($ch); 
 
//echo($result);
$productsarray = json_decode($products, true);


$hits = $productsarray['total_hits'];

$productdata = $productsarray['products'];



// liste der Produkte

foreach($productsarray['products'] as $prod)
{
	
	echo '<div>';
	echo '<a href="'.$_SERVER['PHP_SELF'].'?prodid='.$prod['id'].'">'.$prod['name'].'</a>';
	echo '<img src="'.$prod['image_transparent']['original'].'" alt="'.$prod['name'].'" width="50">';
	echo 'ID: '.$prod['id'] .' ';echo '</br>';
	echo 'name: '.$prod['name'] .' ';echo '</br>';
	echo 'boss_number: '.$prod['boss_number'] .' ';echo '</br>';
	echo '</div>';
	echo '<hr>';
	echo '</br>';
}


echo '<pre>'; print_r($productsarray); echo '</pre>';
} // end if get



if(isset($_GET['prodid'])) {


// https://hackzurich-api.migros.ch
//https://lemon-pebble-032061603.azurestaticapps.net/data
$url = "https://hackzurich-api.migros.ch";
$username = "hackzurich2020";
$password = "uhSyJ08KexKn4ZFS";

$product_api = "products";

$host = 'https://hackzurich-api.migros.ch/products/'.$_GET['prodid'];

$headers = array(
    'Content-Type:application/json'
);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$host);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$products = curl_exec($ch);
curl_close($ch); 
 
//echo($result);
$prod = json_decode($products, true);


	echo '<div>';

	echo '<a href="'.$_SERVER['PHP_SELF'].'?prodid='.$prod['id'].'">'.$prod['name'].'</a>';
	echo '<img src="'.$prod['image_transparent']['original'].'" alt="'.$prod['name'].'" width="50">';
	echo 'ID: '.$prod['id'] .' ';echo '</br>';
	echo 'name: '.$prod['name'] .' ';echo '</br>';
	echo 'boss_number: '.$prod['boss_number'] .' ';echo '</br>';
	echo 'boss_number: '.$prod['boss_number'] .' ';echo '</br>';
	echo 'price: '.$prod['price']['item']['price'] .' ';echo '</br>';
	echo 'origins: '.$prod['origins'] .' ';echo '</br>';
	echo 'kategorie: '.$prod['origins'] .' ';echo '</br>';
	// for all categoerie
	echo '</div>';
	echo '<hr>';
	echo '</br>';
	
echo '<pre>'; print_r($prod); echo '</pre>';
	
} // end if get


?>