<?php
	ob_start(); // Fix headers sent error
	include_once('classes/class-admin.php');
	
	if(isset($_POST['logout'])) {
		session_destroy();
		header('refresh: 0; url=?page=admin');
		ob_end_flush(); // Allows header redirect at the end
		exit(0);
	}
	if(isset($_SESSION['adminLoginStatus'])) {
		$status = $_SESSION['adminLoginStatus'];
	} else {
		$status = 'NotLoggedIn';
	}

	$admin = new Admin($status);
	if($admin->isLogged() == true) {
		$admin->logoutButton();
	} else {
		$admin->displayLogin();
	}
	
?>