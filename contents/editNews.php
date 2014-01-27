<h2>Edit News</h2>
<?php
	if(isset($_SESSION) && $_SESSION['adminLoginStatus'] == 'loginOK') {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
		}
		if(file_exists("contents/" . $_GET['reference'] . ".php")) {
			$reference = $_GET['reference'];
		}
		include(dirname(__DIR__) . "/classes/class-form.php");
		
		// Setup
		$datafile = 'contents/datafiles/news/news.txt';
		$target = 'contents/commitNewsUpdate.php';
		$class = 'adminForm';
		$data = file($datafile);
		$row = $data[$id - 1];
		$elements = explode('|', $row);
		
		// For display purposes only
		$message = str_replace('<br />', "\n", $elements[3]);
		
		// Show the data in a form
		$form = new Form($target, $class);
		$form->addCaption('Title:');
		$form->addTextInput('editTitle', $elements[2]);
		$form->addCaption('Message:');
		$form->addTextarea('editMessage', $message);
		$form->addHiddenInput('editId', $id);
		$form->addHiddenInput('editRef', $reference);
		$form->addSubmit('editSubmit', 'Commit Edit');
		$form->ready();
	}
	
?>
	<a href="?page=index">Cancel Edit</a>
