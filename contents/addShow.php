<?php
	ob_start(); // Allows header redirect at the end
?>
<!doctype html>
<html lang="en">
<head>
	<title>Adding new show</title>
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

	include(dirname(__DIR__) . "/classes/class-writer.php");
	
	// Get existing data
	$datafiles = 'datafiles/shows/*.json';
	$currentFiles = glob($datafiles);
	$nextShowIndex = count($currentFiles) + 1;
	
	// Create new JSON filename
	$path = dirname(__DIR__) . "/contents/datafiles/shows/";
	$basename = 'show';
	if($nextShowIndex < 10) {
		$currentIndex = "00" . $nextShowIndex;
	} else if($nextShowIndex < 100) {
		$currentIndex = "0" . $nextShowIndex;
	} else { 
		$currentIndex = $nextShowIndex; // Max 999 shows currently
	}
	$ext = '.json';
	$target = $path . $basename . $currentIndex . $ext;
			
	// Create the JSON data
	$knownData['artist'] = 'Vortech';
	$knownData['date'] = $_POST['showDate'];
	$knownData['venue'] = $_POST['showVenue'];
	$knownData['city'] = $_POST['showCity'];
	$knownData['country'] = $_POST['showCountry'];
	$knownData['otherBands'] = array(array('name' => $_POST['showOtherBands'], 'country' => '', 'website' => ''));
	// Create placeholders for future data
	$knownData['performers'] = "";
	$knownData['setlist'] = "";
	$knownData['comments'] = "";
	$final = json_encode($knownData, JSON_PRETTY_PRINT);
	
	// Write the JSON data to the file
	$writer = new Writer($target);
	$writer->add($final, 'w');
	
	// Return to shows
	if($writer->writeOk() == true) {
		echo 'Show created ok! Returning..';
		header('refresh: 0; url=../?page=shows');
		ob_end_flush(); // Allows header redirect at the end
		exit(0);
	} else {
		echo 'Could not create show!';
		ob_end_flush(); // Allows header redirect at the end
		exit(1);
	}
	
?>

</body>
</html>