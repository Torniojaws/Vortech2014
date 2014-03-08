<?php
	session_start();
	
	// Includes
	include('classes/class-page.php');
	include('functions/func-getsafetitle.php');

	// Settings
	$title = getSafeTitle();
	$template = 'templates/2014/';
	$_SESSION['template'] = $template;
	$css = $template . 'vortech.css';

	// Generate the page
	$website = new Page($title, $css);
	$website->display($template);
	
?>