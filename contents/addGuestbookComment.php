<!doctype html>
<html lang="en">
<head>
	<title>Add Guestbook Comment</title>
	<style type="text/css">
		body {
			background-color: black;
			color: white;
		}
		input[type="text"], input[type="password"], textarea {
			background-color: #0a1113;
			border: solid 2px #101b1f;
			border-radius: 5px;
			color: silver;
		}
		input[type="text"]:focus, input[type="password"]:focus, textarea:focus {
			outline: none;
			border-color: black;
			box-shadow: 0 0 10px red;
		}
		input[type="submit"] {
			background-color: #131718;
			border-color: black;
			border-radius: 8px;
			color: silver;
			width: 200px;
			height: 50px;
		}

	</style>
	<meta charset="UTF-8" />
</head>
<body>

<?php
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	
		// Setup
		$path = dirname(__DIR__);
		include_once($path . "/classes/class-form.php");
		$datafile = $path . "/contents/datafiles/guestbook/book.txt";
		$guestbookPosts = file($datafile);
		$currentRow = $guestbookPosts[$_GET['id'] - 1]; // 0-indexing
		$elements = explode('|', $currentRow);
		
		// Display post
		echo '<h2>Commenting this post</h2>';
		echo '<p>', $elements[2], '</p>';
		echo '<i>Posted by ', $elements[1], '</i>';
		echo '<hr />';
		
		// Show form
		$target = 'commitAdminComment.php';
		$class = 'adminForm';
		$form = new Form($target, $class);
		$form->addCaption('Admin comment:');
		$form->addTextInput('adminComment');
		$form->addHiddenInput('adminId', $elements[0]);
		$form->addCaption('Submit');
		$form->addSubmit('adminSubmit', 'Add Comment');
		$form->ready();

	}
	
?>
	<a href="../?page=guestbook">Cancel Comment</a>
	
</body>
</html>