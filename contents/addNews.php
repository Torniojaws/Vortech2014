<?php 
	ob_start(); // Fixes headers sent error
?>
<!doctype html>
<html lang="en">
<head>
	<title>Adding News</title>
	<style type="text/css">
		body {
			background-color: black;
			color: red;
		}
	</style>
	<meta charset="UTF-8" />
</head>
<body>

<?php
	// Add news post to datafile, v1.0
	
	// Includes
	$root = dirname(__DIR__);
	include_once($root . '/classes/class-mydate.php');
	include_once($root . '/classes/class-writer.php');
	include_once($root . '/classes/class-validator.php');
	include_once($root . '/classes/class-linkconverter.php');
	
	# Assuming that only safe data is entered from Admin...
	list($newsTitle, $newsMessage) = array_values($_POST);
	
	// Convert link text into hyperlinks
	$convertLinks = new LinkConverter($newsMessage);
	$newsMessage = $convertLinks->getConvertedLinks();
	
	// Datafile for news
	$datafile = 'datafiles/news/news.txt';
	
	// The ingredients for a successful newspost
	$news[] = count(file($datafile)) + 1;
	$news[] = 'Torniojaws'; // I'm the only admin..
	$news[] = $newsTitle;
	$news[] = $newsMessage;
	$myDate = new MyDate('Y-m-d H:i');
	$news[] = $myDate->getDate();
	
	// Validate the array
	$validator = new Validator($news);
	$semifinal = $validator->getSafeData();
	
	// Create the string:
	$final = implode('|', $semifinal);
	$final .= "|\n";
		
	// Write to file
	$writer = new Writer($datafile);
	$writer->add($final, 'a');
	if($writer->writeOk() == true) {
		echo 'Write success! Redirecting...';
		$target = "../?page=index";
		header("Refresh: 0; url=" . $target);
		ob_end_flush(); // Allows header redirect at the end
		exit(0);
	} else {
		echo 'Write failed! Try again.';
		ob_end_flush(); // Allows header redirect at the end
		exit(1);
	}
	
	
?>

</body>
</html>