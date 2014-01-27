<?php
	ob_start(); // Fix headers sent
	session_start();
	include_once('../classes/class-validator.php');
	
	// Convert user input into safe data
	$validator = new Validator($_POST);
	$safeData = $validator->getSafeData();
	
	// Try to login with the given data
	list($name, $pass) = array_values($safeData);
	$hashedName = crypt('***'); // Censored for Git
	$hashedPass = crypt('***'); // Censored for Git
	if(crypt($name, $hashedName) == $hashedName && crypt($pass, $hashedPass) == $hashedPass) {
		$_SESSION['adminLoginStatus'] = 'loginOK';
		$_SESSION['adminName'] = 'Torniojaws';
		echo 'Login OK';
	} else {
		$_SESSION['adminLoginStatus'] = 'loginFailed';
		echo 'Login Fail';
	}
	header('Refresh: 0; url=../?page=admin');
	ob_end_flush(); // Allows header redirect at the end
	exit(0);
?>