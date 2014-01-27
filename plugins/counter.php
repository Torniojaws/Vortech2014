<?php

	# Setup
	require_once('classes/class-counter.php');
	$datafile = 'visitors.txt';
	
	# Make the ends meet
	$counter = new Counter($datafile);
	$counter->incrementPerSession();

?>