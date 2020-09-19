<?php
header('Content-Type: image/jpeg');

$theImage = imagecreatefromjpeg ( './assets/images/0jpg' );
//$theImage = imagecreatefrompng("assets/images/0jpg");

//$imgWidth = '800';
//$imgHeight = '600';

//$theImage = imagecreate($imgWidth, $imgHeight);
$colorWhite = imagecolorallocate($theImage, 255, 255, 255); #Hintergrund
$colorGrey = imagecolorallocate($theImage, 210, 210, 210);
$colorGreen = imagecolorallocate($theImage, 0, 128, 0);

$theImage = imagecreatefrompng("assets/images/0jpg");
imageline($theImage, 0, 0, $imgWidth, 0, $colorGrey); #oben
imageline($theImage, $imgWidth-1, 0, $imgWidth-1, $imgHeight-1, $colorGrey); #rechts
imageline($theImage, 0, $imgHeight-1, $imgWidth, $imgHeight-1, $colorGrey); #unten
imageline($theImage, 0, 0, 0, $imgHeight, $colorGrey); #links

$pxRaster = '20'; #Größe des Rasters
$pxWidth = round($imgWidth / $pxRaster, 0);
for($i=1; $i<$pxWidth; $i++)
	{
	imageline($theImage, $i*$pxRaster, 0, $i*$pxRaster, $imgHeight, $colorGrey); #vertikal
	imageline($theImage, 0, $i*$pxRaster, $imgWidth, $i*$pxRaster, $colorGrey); #horizontal
	}
	
imageline($theImage, 10, 10, 50, 50, $colorGreen); #links

//Ausgabe
imagepng($theImage); #ausgeben des Bildes als PNG
imagedestroy($theImage); #freigeben und zerstören des Bildes
?>