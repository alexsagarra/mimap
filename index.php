<?php
session_start();

if(isset($_GET['logout'])) { 
	session_destroy();
	unset($_SESSION['basket']);
	}



if(isset($_GET['search'])) { $search = $_GET['search'];} else {$search = ''; }


include('func.php');

if(isset($_GET['prodiddelete'])) {
//prodiddelete
unset($_SESSION["basket"][$_GET['prodiddelete']]);

}

if(isset($_GET['prodid'])) {
	
	$productdata = get_product('products/'.$_GET['prodid']);
	//echo '<pre>'; print_r($productdata); echo '</pre>';
	
$_SESSION["basket"][$_GET['prodid']]['name'] = $productdata['name'];
$_SESSION["basket"][$_GET['prodid']]['price'] = $productdata['price']['item']['price'];
$_SESSION["basket"][$_GET['prodid']]['img'] = $productdata['image']['original'];
$_SESSION["basket"][$_GET['prodid']]['id'] = $productdata['id'];


}
//echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>MIMAP - shortest path shopping
</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/css/slick.css">
        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">
        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="assets/css/animate.css">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">
 
<script type="module">
            import {ready} from "./utils.js";
            import {visualize_store} from "./visualization.js";


            ready(function(){
                var canvas = document.getElementById('canvas');
                visualize_store(canvas);
                console.log(canvas);
            });
        </script>
</head>

<body>





		
		
		
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
   
   
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="navbar-area headroom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.php">
                                <img src="assets/images/mimap_logo.png" alt="Logo" height="30px">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav m-auto">
                                    <li class="nav-item active">
                                        <a href="#home">Search</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#store">Store </a>
                                    </li>
                                    <!--<li class="nav-item">
                                        <a href="#products">Product Check</a>
                                    </li>-->
									<li class="nav-item">
                                        <a href="#basket">Shoppinglist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#services">About</a>
                                    </li>
									
									<!--
                                    <li class="nav-item">
                                        <a href="#blog">Blog</a>
                                    </li>
									-->
                                    <li class="nav-item">
                                        <a href="#contact">Contact</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            
                            <div class="navbar-btn d-none d-sm-inline-block">
                                <a class="main-btn" data-scroll-nav="0" href="index.php?logout">Logout</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="header-hero bg_cover d-lg-flex align-items-center" style="background-image: url(assets/images/header-hero.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-hero-content">
                            <h1 class="hero-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"><b>Hack</b> <span><b>Migros</b></span></br> shortest path shopping</b></h1>
                            <div class="header-singup wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                             <?php

if(isset($_GET['search'])) { $search = $_GET['search'];} else {$search = ''; }

?>   
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>#products" method="get">
									<input type="text" name="search" value="<?=$search?>" placeholder="search products for fast shopping" autofocus>
									<button class="main-btn" type="submit">search</button>
								</form>

								
								


                            </div>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header-hero-image d-flex align-items-center wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="1.1s">
                <div class="image">
                    <img src="assets/images/mimap.png" alt="mimap">
                </div>
            </div> <!-- header hero image -->
        </div> <!-- header hero -->
    </header>
    
    <!--====== HEADER PART ENDS ======-->
    
    <!--====== ABOUT PART START ======-->
    
   
    

    
    <!--====== PROJECT GALLERY PART START ======-->

    <section id="products" class="project-masonry-area pt-115">
        <div class="container">
			
			
			
<div class="row">			
<?php

if(isset($_GET['search'])) { 
	$product_search = get_product('products?search='.$_GET['search']);

	if($product_search['total_hits']<=1){ 

	echo '<div class="col-lg-4 col-md-6">

	<img src="assets/images/pixi.png" alt="" width="300px" height="300px">
	<div><h2>keine Produkte gefunden, bitte versuchen Sie es erneut.</h2></div>
	</div>
	';
	echo '</div>';

} 
else {
	
foreach($product_search['products'] as $prod )
{
echo '
<div class="col-lg-4 col-md-6">
	<div class="single-contact-info contact-color-1 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
			<div class="contact-info-icon">
			<img src="'.$prod['image']['original'].'" alt="'.$prod['name'].'" width="50">
			</div>
		<div class="contact-info-content media-body">';
		echo '<h6><a href="'.$_SERVER['PHP_SELF'].'?prodid='.$prod['id'].'">'.$prod['name'].'</a></h6>';
		if(!empty($prod['price']['item']['price'])) {echo '<h4 class="title">'.$prod['price']['item']['price'].'</h4>';	}
		if(!empty($prod['categories'][0]['name'])) {echo '<h4 class="title">'.$prod['categories'][0]['name'].'</h4>';}
		echo '</div>';
	echo '</div>'; //<!-- single contact info -->
echo '</div>';
}

//echo '<pre>'; print_r($product_search); echo '</pre>';
}

}?>
</div> <!-- row -->		
					
				
			
			
<!--
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery-btn mt-60 text-center">
                        <a class="main-btn" href="#">Load More</a>
                    </div>
                </div>
            </div> <!-- row -->
			
        </div> <!-- container -->
    </section>

   


   
   
   <!--====== basket PART START ======-->
    
    <section id="basket" class="testimonial-area pt-70 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial-left-content mt-45 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="section-title">
                            <h6 class="sub-title">shopping basket</h6>
                            <h4 class="title">check items</h4>
							<img src="assets/images/basket.png" alt="" width="50">
                        </div> <!-- section title -->
                
                        <!--
						<p class="text">Duis et metus et massa tempus lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ultricies, orci molestie blandit interdum. <br> <br> ipsum ante pellentesque nisl, eget mollis turpis quam nec eros. ultricies, orci molestie blandit interdum.</p>
						-->
                    </div> <!-- testimonial left content -->
                </div>
				
						<?php
						/*
						foreach ( $_SESSION['basket'] as $basket)
						{
							
						//$productdata = get_product('products/'.$_GET['prodid']);
			//			
		//				$_SESSION["basket"][$_GET['prodid']]['name'] = $productdata['name'];
	//					$_SESSION["basket"][$_GET['prodid']]['price'] = $productdata['price']['item']['price'];
//						$_SESSION["basket"][$_GET['prodid']]['img'] = $productdata['image']['original'];
//						$_SESSION["basket"][$_GET['prodid']]['id'] = $productdata['id'];
						
						
						echo '
<div class="col-lg-12">
	<div class="single-contact-info contact-color-1 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
			<div class="contact-info-icon">
			<img src="'.$basket['img'].'" alt="'.$basket['name'].'" height="100">
			</div>
		<div class="contact-info-content media-body">';
		echo '<h6><a href="'.$_SERVER['PHP_SELF'].'?prodid='.$basket['id'].'">'.$basket['name'].'</a></h6>';
		if(!empty($basket['price'])) {echo '<h4 class="title">'.$basket['price']['item']['price'].'</h4>';	}
		if(!empty($basket['name'])) {echo '<h4 class="title">'.$basket['name'].'</h4>';}
		//echo '<h4 class="title"><a href=''.$_SERVER['PHP_SELF'].'?prodiddelete='.$productdata['id'].''>delete</a></h4>';
		
		echo '</div>';
	echo '</div>'; //<!-- single contact info -->
echo '</div>';
	
						}
						*/
						?>
					




<div class="single-contact-info contact-color-1 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
	
	
	<div class="col-lg">
		<div>
			<img src="https://image.migros.ch/2017-large/d5f9fad42ccadca945be9ec6806a99aa4c66b32c/bio-you-spaghetti-gelbe-linsen.jpg" alt="" width="200px"  >
		</div>
		<div class="contact-info-content media-body">
			<h6><a href="">Bio YOU Spaghetti gelbe Linsen</a></h6>
			<h4 class="title"></h4>
		</div>
	</div>
	
	<div class="col-lg">
		<div>
			<img src="https://image.migros.ch/2015-medium/bf1d657a5910dbd9eb4013ae5fa03dfd79c0a3d5/knoblauch.jpg" alt="" height="200px"  width="300">
		</div>
		<div class="contact-info-content media-body">
			<h6><a href="">Knoblauch</a></h6>
			<h4 class="title">Spanien, Netz, 250 g Angebot gilt nur vom 15.9. bis 28.9.2020, solange Vorrat.</h4>
			<h4 class="title"></h4>
		</div>
	</div>
	
	<div class="col-sm">
		<div class="contact-info-icon">
			<img src="https://image.migros.ch/2015-medium/dcd393eb91885f3b449b18e6badac2528961ade9/federkohl.jpg" alt="" height="200px"  width="300">
		</div>
		<div class="contact-info-content media-body">
			<h6><a href="">Federkohl</a></h6>
			<h4 class="title">2.75 CHF</h4>

		</div>
	</div>
	
	
	<div class="col-sm">
		<div class="contact-info-icon">
			<img src="https://image.migros.ch/2015-large/670fe699cd6c3f12091a51dc32c6d1019a08641e/cayennepfeffer-gemahlen.jpg" alt="" height="200px"  width="300">
		</div>
		<div class="contact-info-content media-body">
			<h6><a href="">Cayennepfeffer gemahlen</a></h6>
			<h4 class="title">0.55 CHF</h4>

		</div>
	</div>
	
	<div class="col-sm">
		<div class="contact-info-icon">
			<img src="https://image.migros.ch/2017-large/897bbf36b95cf4f39f2c54ca071ad8455a054277/bio-tilsiter-rahm.jpg" alt="" height="200px" width="300">
		</div>
		<div class="contact-info-content media-body">
			<h6><a href="">Bio Tilsiter Rahm</a></h6>
			<h4 class="title">1.95 CHF</h4>

		</div>
	</div>
	
	
	

				
				
</div><!-- single contact info -->


<div class="testimonial-left-content mt-45 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">

<p class="text">Duis et metus et massa tempus lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ultricies, orci molestie blandit interdum. <br> <br> ipsum ante pellentesque nisl, eget mollis turpis quam nec eros. ultricies, orci molestie blandit interdum.</p>

</div>
            
			
			
					
					
</div> <!-- row -->	
					
					
					
        </div> <!-- container -->
    </section>
	<!--====== basket ======-->
	
	


   <!--====== PROJECT GALLERY PART ENDS ======-->
 
 
  <section id="store" class="about-area pt-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="about-title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h6 class="welcome">Store Overview</h6>
                        <h3 class="title"><span>Find the best and fastest Way</span> on your shopping tour.</h3>
                    </div>
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-image mt-60 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="assets/images/3d/3d1.png">
						<!--<img src="bild.php" alt="store">-->
						<!-- Use it like any other HTML element -->
<div class="col-lg-8" style="width: 200px; margin-right=-100px;">
<!--
<canvas id="canvas"  style="width: 200px; margin-right=-100px;">Your browser does not support HTML5 canvas</canvas>
-->
</div>		
                    </div> <!-- about image -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="about-content pt-45">
                        <p class="text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">Duis et metus et massa tempus lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ultricies, orci molestie blandit interdum. ipsum ante pellentesque nisl, eget mollis turpis quam nec eros. ultricies, orci molestie blandit interdum.</p>
                        
                        <div class="about-counter pt-60">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="single-counter counter-color-1 mt-30 d-flex wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                                        <div class="counter-shape">
                                            <span class="shape-1"></span>
                                            <span class="shape-2"></span>
                                        </div>
                                        <div class="counter-content media-body">
                                            <span class="counter-count"><span class="counter">350</span>co2</span>
                                            <p class="text">Climate co2</p>
                                        </div>
                                    </div> <!-- single counter -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="single-counter counter-color-2 mt-30 d-flex wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                                        <div class="counter-shape">
                                            <span class="shape-1"></span>
                                            <span class="shape-2"></span>
                                        </div>
                                        <div class="counter-content media-body">
                                            <span class="counter-count"><span class="counter">99</span>%</span>
                                            <p class="text">allergy</p>
                                        </div>
                                    </div> <!-- single counter -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="single-counter counter-color-3 mt-30 d-flex wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">
                                        <div class="counter-shape">
                                            <span class="shape-1"></span>
                                            <span class="shape-2"></span>
                                        </div>
                                        <div class="counter-content media-body">
                                            <span class="counter-count"><span class="counter">870</span>kj</span>
                                            <p class="text">calories</p>
                                        </div>
                                    </div> <!-- single counter -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- about counter -->
                    </div> <!-- about content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== ABOUT PART ENDS ======-->
 
 
 

    
    
    
	
	    <!--====== OUR SERVICE PART START ======-->
    

    
    <!--====== OUR SERVICE PART ENDS ======-->
    
    <!--====== SERVICE PART START ======-->
    
    <section id="services" class="service-area pt-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h6 class="sub-title">Idea</h6>
                        <h4 class="title">Hack Zürich 2020 </br><span>MIGROS Challenge</span></h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="service-wrapper mt-60 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-3 col-md-9">
                        <div class="single-service d-flex">
                            <div class="service-icon">
                                <img src="assets/images/service-3.png" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Alex 1</h4>
								
                                <img src="assets/images/alex1.jpg" alt="" width="200">
                                <p class="text">Hardcore 3d Coder</p>
                            </div>
                            <div class="shape shape-5">
                                <img src="assets/images/shape/shape-5.svg" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
					<div class="col-lg-3 col-md-9">
                        <div class="single-service d-flex">
                            <div class="service-icon">
                                <img src="assets/images/service-1.png" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Luca</h4>
                                <img src="assets/images/luca.jpg" alt="" width="200">
								<p class="text">Video & coding</p>
                            </div>
                            <div class="shape shape-1">
                                <img src="assets/images/shape/shape-1.svg" alt="shape">
                            </div>
                            <div class="shape shape-2">
                                <img src="assets/images/shape/shape-2.svg" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
                    <div class="col-lg-3 col-md-9">
                        <div class="single-service service-border d-flex">
                            <div class="service-icon">
                                <img src="assets/images/service-2.png" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Lawrence</h4>
                                <img src="assets/images/lawence.jpg" alt="" width="200">
                                <p class="text">Video & coding</p>
                            </div>
                            <div class="shape shape-3">
                                <img src="assets/images/shape/shape-3.svg" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
                    <div class="col-lg-3 col-md-9">
                        <div class="single-service d-flex">
                            <div class="service-icon">
                                <img src="assets/images/service-3.png" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Alex S</h4>
                                <img src="assets/images/alexx.jpg" alt="" width="200">
                                <p class="text">Web & Coding</p>
                            </div>
                            <div class="shape shape-5">
                                <img src="assets/images/shape/shape-5.svg" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
					
					
					
					
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="service-btn text-center pt-25 pb-15">
                            <a class="main-btn main-btn-2" href="#">more</a>
                        </div> <!-- service btn -->
                    </div>
                </div> <!-- row -->
            </div> <!-- service wrapper -->
        </div> <!-- container -->
    </section>
    
    <!--====== SERVICE PART ENDS ======-->
	
	
	
    <!--====== BRAND PART START ======-->
    
    <div id="brand" class="brand-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-wrapper pt-70 clearfix">
                        <div class="single-brand mt-50 text-md-left wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                            <img src="assets/images/brand_m.png" alt="brand" height="100px">
                        </div> <!-- single brand -->
                        <div class="single-brand mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                            <img src="assets/images/brand-microsoft.png" alt="brand" height="100px">
                        </div> <!-- single brand -->
                        <div class="single-brand mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                            <img src="assets/images/brand-swissmade.png" alt="brand" height="100px">
                        </div> <!-- single brand -->
                        <div class="single-brand mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="assets/images/brand-4.png" alt="brand" height="100px">
                        </div> <!-- single brand -->
                    </div> <!-- brand wrapper -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>
    
    <!--====== BRAND PART ENDS ======-->
    
    
    
    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="section-title text-center pb-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h6 class="sub-title">Our Contact</h6>
                        <h4 class="title">Get In <span>Touch.</span></h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="contact-info pt-30">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                            <div class="contact-info-icon">
                                <i class="lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">Technoparkstrasse 1 <br> 8005 Zürich.</p>
								
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                            <div class="contact-info-icon">
                                <i class="lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">sales-mmmata@hackzurich.ch</p>
                                <p class="text">m-api-mmmata@hackzurich.ch</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex  wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">
                            <div class="contact-info-icon">
                                <i class="lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+41 00 000 00 00</p>
                                <p class="text">+41 00 000 00 00</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper-form pt-115  wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4 class="contact-title pb-10"><i class="lni-envelope"></i> Leave <span>A Message.</span></h4>
                        <?php
						// if ist send a message ?????
						
						?>
                        <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>#contact" method="post">
						<input type="hidden" name="contact" value="contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-form mt-45">
                                        <label>Enter Your Name</label>
                                        <input type="text" name="name" placeholder="Full Name">
                                    </div> <!-- contact-form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-form mt-45">
                                        <label>Enter Your Email</label>
                                        <input type="email" name="email" placeholder="Email">
                                    </div> <!-- contact-form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-form mt-45">
                                        <label>Your Message</label>
                                        <textarea name="message" placeholder="Enter your message..."></textarea>
                                    </div> <!-- contact-form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="contact-form mt-45">
                                        <button type="submit" class="main-btn">Send Now</button>
                                    </div> <!-- contact-form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
    
    <!--====== FOOTER PART START ======-->
    
    <footer id="footer" class="footer-area bg_cover" style="background-image: url(assets/images/footer-bg.jpg)">
        <div class="container">
            <div class="footer-widget pt-30 pb-70">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 order-sm-1 order-lg-1">
                        <div class="footer-about pt-40">
                            <a href="#">
                                <img src="assets/images/pixi.png" alt="Logo">
                            </a>
                            <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, repudiandae! Totam, nemo sed? Provident.</p> <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus</p>
                        </div> <!-- footer about -->
                    </div>
                    <div class="col-lg-3 col-sm-6 order-sm-3 order-lg-2">
                        <div class="footer-link pt-40">
                            <div class="footer-title">
                                <h5 class="title">Services & Links</h5>
                            </div>
                            <ul>
                                <li><a href="https://www.migros.ch/de/hackzurich.html" target="_blank">Migros Hack Zürich</a></li>
                                <li><a href="https://www.youtube.com/watch?v=NHSRM9t7ouQ" target="_blank">YouToube</a></li>
                                <li><a href="https://devpost.com/software/mi-mapi/"  target="_blank">devpost</a></li>
                                <li><a href="https://github.com/alexsagarra/mimap"   target="_blank">GIT</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-sm-6 order-sm-4 order-lg-3">
                        <div class="footer-link pt-40">
                            <div class="footer-title">
                                <h5 class="title">About Us</h5>
                            </div>
                            <ul>
                                <li><a href="https://hackzurich.com/" target="_blank">hackzurich</a></li>
                                <li><a href="https://twitter.com/hackzurich"  target="_blank">twitter</a></li>
                                <li><a href="https://www.migros.ch/" target="_blank">Awards & Recognitions</a></li>
                                <li><a href="#services" target="_blank">Team</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-lg-3 col-sm-6 order-sm-2 order-lg-4">
                        <div class="footer-contact pt-40">
                            <div class="footer-title">
                                <h5 class="title">Contact Info</h5>
                            </div>
                            <div class="contact pt-10">
                                <p class="text">Technoparkstrasse 1 <br>
                                    8005 Zürich
</p>
                                <p class="text">m-data@hackzurich.ch</p>
                                <p class="text">+41 00 000 00 00</p>

                                <ul class="social mt-40">
                                    <li><a href="#"><i class="lni-facebook"></i></a></li>
                                    <li><a href="#"><i class="lni-twitter"></i></a></li>
                                    <li><a href="#"><i class="lni-instagram"></i></a></li>
                                    <li><a href="#"><i class="lni-linkedin"></i></a></li>
                                </ul>
                            </div> <!-- contact -->
                        </div> <!-- footer contact -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer widget -->
            <div class="footer-copyright text-center">
                <p class="text">© 2022 Crafted with &#10084; by Team <a href="https://www.saganet.ch" rel="nofollow">Mmmmata</a> All Rights Reserved.</p>
            </div>
        </div> <!-- container -->
    </footer>
    
    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->  




    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>
    
    <!--====== Isotope js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    
    <!--====== Circles js ======-->
    <script src="assets/js/circles.min.js"></script>
    
    <!--====== Appear js ======-->
    <script src="assets/js/jquery.appear.min.js"></script>
    
    <!--====== WOW js ======-->
    <script src="assets/js/wow.min.js"></script>
    
    <!--====== Headroom js ======-->
    <script src="assets/js/headroom.min.js"></script>
    
    <!--====== Jquery Nav js ======-->
    <script src="assets/js/jquery.nav.js"></script>
    
    <!--====== Scroll It js ======-->
    <script src="assets/js/scrollIt.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
	

		
 
    
</body>

</html>
