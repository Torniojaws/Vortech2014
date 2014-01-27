<?php
	list($id, $rating) = array_values($_POST);
	include('../classes/class-ratingcalculator.php');
	
	$file = "../contents/ratings/".$id.".txt";
	$db = new RatingCalculator($file);
	$db->add($rating);
	
?>