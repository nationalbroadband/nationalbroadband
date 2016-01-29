<?php
/**
*
*	Name: 		Short Digit Value Helper
*	Devloper:	Asad
*	Date:		28-01-2016 9:00 AM
*
**/
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('short_digit_value')){
	
	function  short_digit_value($value){
		
		if ($value > 999 && $value <= 999999) {
			$result = floor($value / 1000);
			$result = decimalValue($result);
		}elseif ($value > 99999 && $value <= 999999999) {
			$result = floor($value / 1000000).'M';
		}elseif ($value > 999999999 && $value <= 999999999999) {
			$result = floor($value / 1000000000) .'B';
		}elseif ($value > 999999999999) {
			$result = floor($value / 1000000000000) .'T';
		}else {
			$value > 0 ? $value : $value;
			$result = $value;
		}
		return $result;
	}
	
	
	
	function decimalValue($result){
		/*if(strlen($result)==1){
			intval($result);
			return $result = $result/10;
			}
		if(strlen($result)==2){
			intval($result);
			return $result = $result/100;
			}*/
		if(strlen($result)==3){
			$result = substr($result, 0, 1);
			intval($result);
			$result = $result/10;
			return $result.'M';
			}else{
				return $result.'K';
				}
			
		}	
}