<?php
	session_start();
	
	// Includes
	include('classes/class-page.php');
	include('functions/func-getsafetitle.php');

	// Settings
	$title = getSafeTitle();
	$template = 'templates/vortech/';
	$css = $template . 'vortech.css';

	// Generate the page
	$website = new Page($title, $css);
	$website->display($template);
	
?>