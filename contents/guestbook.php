<h2>Guestbook</h2>
<?php
	include('classes/class-guestbook.php');
	include('classes/class-form.php');
	include('classes/class-antispam.php');
?>
<aside class="guestbookForm">
<?php
	$antispam = new Antispam('contents/datafiles/antispam/antispam.txt');
	$storedName = null;
	$storedMessage = null;
	
	$form = new Form('contents/guestbookFormProcessor.php');
	$form->addCaption('Name:');
	if(isset($_GET['error']) && isset($_SESSION['guestbookName'])) {
		$storedName = $_SESSION['guestbookName'];
	}
	$form->addTextInput('name', $storedName);
	$form->addCaption("Antispam: " . $antispam->getQuestion());
	if(isset($_GET['error'])) {
		$form->addCaption('<span class="red">Incorrect antispam answer!</span>');
	}
	$form->addTextInput('antispam');
	$form->addHiddenInput('antispamIndex', $antispam->getIndex());
	$form->addCaption('Message');
	if(isset($_GET['error']) && isset($_SESSION['guestbookMessage'])) {
		$storedMessage = $_SESSION['guestbookMessage'];
	}
	$form->addTextarea('message', $storedMessage);
	$form->addSubmit('submit', 'Send');
	$form->ready();
?>
</aside>
<div class="guestbookMessages">
<?php	
	$datafile = 'contents/datafiles/guestbook/book.txt';
	$book = new Guestbook($datafile);
	$book->show();
?>
</div>
<div class="clear"></div>