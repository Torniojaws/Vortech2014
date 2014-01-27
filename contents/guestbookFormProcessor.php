<?php
	ob_start(); // Otherwise will not redirect correctly
	session_start();
	
	require_once('../classes/class-validator.php');
	require_once('../classes/class-validpost.php');
	require_once('../classes/class-writer.php');
	require_once('../classes/class-antispam.php');
?>
<!doctype html>
<html lang="en">
<head>
	<title>Add Guestbook Comment</title>
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
	// Process POST data
	$unsafeFormData = array_values($_POST);
	$validator = new Validator($unsafeFormData);
	
	// Create the string to write
	$safeFormObject = $validator->getSafeData();
	$validator2 = new Validator($safeFormObject);
	$reallySafeFormObject = $validator2->getSafeData();
	$delimitedPost = new ValidPost($reallySafeFormObject, '|');
	$final = $delimitedPost->getPost();
	
	// Check the antispam answer (p1=answer, p2=index)
	$antispam = new Antispam('datafiles/antispam/antispam.txt');
	// Store data to session, for retrieving the user data after antispam error
	$_SESSION['guestbookName'] = $delimitedPost->unformatted[0];
	$_SESSION['guestbookMessage'] = $delimitedPost->unformatted[3];
	$unsafeAnswer = $delimitedPost->unformatted[1];
	$questionIndex = $delimitedPost->unformatted[2];
	if($antispam->answerIsCorrect($unsafeAnswer, $questionIndex) == true) {
		$file = 'datafiles/guestbook/book.txt';
		$writer = new Writer($file);
		$writer->add($final, 'a');
		
		// All done, return to base
		if($writer->writeOk() == true) {
			echo 'File updated OK! Returning to base...';
		} else {
			echo 'Write failed!';
		}
		$url = '../?page=guestbook';
	} else {
		echo 'ERROR Could not update file! Returning...';
		$url = '../?page=guestbook&error=1';
	}
	header('Refresh: 0; url='.$url);
	ob_end_flush(); // Allows header redirect at the end
	exit(0);
	
?>

</body>
</html>