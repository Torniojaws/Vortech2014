<?php
	include('classes/class-page.php');
	
	// Settings
	$title = 'Admin';
	$template = 'templates/vortech/';
	$css = $template . 'vortech.css';
	
	// Show the goods!
	$admin = new Page($title, $css);
	$admin->display($template);
	
?>