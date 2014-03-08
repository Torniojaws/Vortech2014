<h2>Shows</h2>
<?php
	include('classes/class-form.php');
	
	// Admin can add new shows, when logged in
	if(isset($_SESSION['adminLoginStatus']) && $_SESSION['adminLoginStatus'] == 'loginOK') {
		echo '<hr /><b>Add new:</b>';
		$newShow = new Form('contents/addShow.php', 'adminForm');
		$newShow->addCaption('Date (Y-m-d)');
		$newShow->addTextInput('showDate');
		$newShow->addCaption('Venue');
		$newShow->addTextInput('showVenue');
		$newShow->addCaption('City');
		$newShow->addTextInput('showCity');
		$newShow->addCaption('Country');
		$newShow->addTextInput('showCountry');
		$newShow->addCaption('Other Bands - add website later');
		$newShow->addTextInput('showOtherBands');
		$newShow->addSubmit('showSubmit', 'Add');
		$newShow->ready();
		echo '<hr />';
	}
?>
<h3 class="liveshowTitleText">Upcoming Shows</h3>
<?php
	include('classes/class-show.php');

	// Setup
	$showsDataLocation = 'contents/datafiles/shows/*.json';
	$showsDataFiles = glob($showsDataLocation);
	rsort($showsDataFiles); // Rsort = newest release first, comment out to show oldest first
	
	// Show the shows
	$flag = 0;
	foreach($showsDataFiles as $showData) {
		$show = new Show($showData);
		// Display "Past Shows" title once
		if(strtotime($show->showDate) < time()) {
			if($flag == 0) {
				echo '<h3 class="liveshowTitleText">Past Shows</h3>';
				$flag = 1;
			}			
		}
		$show->display();
	}
	
?>

<script src="plugins/jquery.bpopup.min.js"></script>
<script src="plugins/modaali.js"></script>