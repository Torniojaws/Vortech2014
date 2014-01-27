<h2>Releases</h2>
<?php
	include('classes/class-release.php');
	include('classes/class-rating.php');
	
	// Get release data
	$releasesDataLocation = 'contents/datafiles/releases/*.json';
	$releasesDataFiles = glob($releasesDataLocation);
	rsort($releasesDataFiles); // Rsort = newest release first, comment out to show oldest first
	
	// Show the releases
	foreach($releasesDataFiles as $releaseData) {
		$release = new Release($releaseData);
		$release->display();
	}
?>


<script src="plugins/jquery.bpopup.min.js"></script>
<script src="plugins/releases.js"></script>