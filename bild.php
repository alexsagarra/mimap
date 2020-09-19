<?php
function LoadJpeg($imgname)
{
    /* Versuche zu öffnen */
    $im = imagecreatefromjpeg($imgname);

    /* Prüfe, ob das fehlschlug */
    if(!$im)
    {
        /* Erzeuge ein schwarzes Bild */
        $im  = imagecreatetruecolor(150, 30);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
		imagesetthickness($im, 5);
		
		$colorWhite = imagecolorallocate($theImage, 255, 255, 255); #Hintergrund
		$colorGrey = imagecolorallocate($theImage, 210, 210, 210);
		$colorGreen = imagecolorallocate($theImage, 0, 128, 0);

		imageline($im, 0, 50, 50, 60, $colorWhite); #links


        /* Gib eine Fehlermeldung aus */
        imagestring($im, 1, 5, 5, 'Fehler beim Laden von ' . $imgname, $tc);
    }

    return $im;
}

header('Content-Type: image/jpeg');

$img = LoadJpeg('assets/images/0.jpg');

imagejpeg($img);
imagedestroy($img);
?>