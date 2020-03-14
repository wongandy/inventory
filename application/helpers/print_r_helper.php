<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('pr'))
{
	function pr($value = '')
	{
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		return die;
	}
}