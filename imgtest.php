<?php


function displayScaledImage($path, $outputFormat = "png", $width = null, $height = null) {
	//SEXY function that dynamically scales an image from a file
	//and outputs it to the browser
	//requires a path and a width
	//height and format (png or jpeg) are optional, set height to null if unwanted
	//default height calculated in relation to width
	//default format is png


	if($outputFormat == "png"){
		$cleanFormat = "png";
	}elseif($outputFormat == "jpeg" || $outputFormat == "jpg"){
		$cleanFormat = "jpeg";
	}elseif($outputFormat == "gif"){
		$cleanFormat = "gif";
	}else{
		$cleanFormat = null;
		return 0;
		// "Image Scaler Error: Invalid Format"
	}

	$img = file_get_contents($path);
	$img = imagecreatefromstring($img);

	if($height == null){
		$img = imagescale($img, $width);
		//die($width);
	}else{
		$img = imagescale($img, $width, $height);
	}

	header('Content-Type: image/'.$cleanFormat);

	if($cleanFormat == "jpeg"){
		$img = imagejpeg($img);
		return true;
	}elseif($cleanFormat == "png"){
		$img = imagepng($img);
	//	echo "LOL NOPE";
		return true;
	}elseif($cleanFormat == "gif"){
		$img = imagegif($img);
		return true;
	}else{
		return -1;
	//	Image Scaler Error: Error Outputting Image, check the path & other parameters
	}

}

displayScaledImage("chico-and-kat.jpg", "gif", 500);

/*
$img = file_get_contents("chico-and-kat.jpg");
$img = imagecreatefromstring($img);
$img = imagescale($img, 500);
header('Content-Type: image/jpeg');
$img = imagejpeg($img);
*/
?>