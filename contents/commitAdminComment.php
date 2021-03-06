<?php
	ob_start(); // Fix headers sent
?>
<!doctype html>
<html lang="en">
<head>
	<title>Committing Admin Comment</title>
	<style type="text/css">
		body {
			background-color: black;
			color: white;
		}
	</style>
	<meta charset="UTF-8" />
</head>
<body>

<?php

	include(dirname(__DIR__) . "/classes/class-validator.php");
	include(dirname(__DIR__) . "/classes/class-writer.php");
	
	// Setup
	$datafile = 'datafiles/guestbook/book.txt';
	
	// Get the original data
	$original = file($datafile, FILE_IGNORE_NEW_LINES);
	$originalRow = $original[$_POST['adminId'] - 1];
	$originalArray = explode('|', $originalRow);
	
	// Create the new row (index, poster, message, date, admin comment)
	$newRow[] = $originalArray[0];
	$newRow[] = $originalArray[1];
	$newRow[] = $originalArray[2];
	$newRow[] = $originalArray[3];
	$newRow[] = $_POST['adminComment'];
	$final = implode('|', $newRow);
	$final .= "|";

	// Verify
	$hasErrors = false;
	if(strlen($final) < 6 || empty($newRow[2]) || empty($newRow[3])) {
		// Something is probably wrong
		echo 'Something might be wrong...';
		echo 'String length of Final = ', strlen($final);
		if(empty($newRow[2])) { echo 'Title is empty!'; }
		if(empty($newRow[3])) { echo 'Message is empty!'; }
		$hasErrors = true;
	}
	
	// Replace old row with new row
	if($hasErrors == true) {
		echo 'Not updating, something seems wrong!';
		exit(1);
	} else {
		// p1=original data, p2=target row, p3=replace, p4=replace with this data
		array_splice($original, $newRow[0]-1, 1, $final);  // -1 for indexing
		file_put_contents($datafile, join("\n", $original));
	}
	
	// Without this, the array_splice above will remove the last empty row in the file
	// and the next new item will be in the same row as the previous
	$writer = new Writer($datafile);
	$writer->add("\n", 'a');
	
	// Return to news
	echo 'Updated OK, returning...';
	header('refresh: 0; url=../?page=guestbook');
	ob_end_flush(); // Fix headers
	exit(0);
	
?>

</body>
</html>