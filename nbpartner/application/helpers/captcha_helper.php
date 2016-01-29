<?php
/**
*
*	Name: 		Captcha Helper
*	Devloper:	Amjad Memon
*	Date:		26-01-2016 9:00 PM
*
**/
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('create_captcha'))
{
	
	function  create_captcha($time){	
	@session_start();
	$image;	
    global $image;
	
		$word_1 = '';
		$word_2 = "";
		for ($i = 0; $i < 4; $i++) 
		{
			$word_1 .= chr(rand(97, 122));
		}
		for ($i = 0; $i < 4; $i++) 
		{
			$word_2 .= chr(rand(97, 122));
		}

		$_SESSION['random_number'] = $word_1.' '.$word_2;
		$dir = './fonts/';
		
		$image = imagecreatetruecolor(165, 50);

		$font = "recaptchaFont.ttf"; // font style

		$color = imagecolorallocate($image, 0, 0, 0);// color

		$white = imagecolorallocate($image, 255, 255, 255); // background color white

		imagefilledrectangle($image, 0,0, 709, 99, $white);

		imagettftext ($image, 22, 0, 5, 30, $color, $dir.$font, $_SESSION['random_number']);
		$_SESSION['count'] = $_SESSION['random_number'];
		$_SESSION['captcha_string'] = $_SESSION['random_number'];
		
		$images = glob("./style/captcha/*.png");
		foreach ($images as $image_to_delete) {
			@unlink($image_to_delete);
		}
	
		imagepng($image,"./style/captcha/".$time.".png");
	
		//return array('image'=>$image,'count'=>$_SESSION['count']);
	}	
}