<?php
	include('class-form.php');

	$target = 'formProcessor.php';
	$form = new Form($target);
	$form->addCaption('Your name: ');
	$form->addTextInput('name');
	$form->addCaption('Your message: ');
	$form->addTextarea('message');
	$form->addSubmit('submit', 'Send');
	$form->ready();
	
?>