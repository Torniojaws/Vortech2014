<?php

	function getSafeTitle() {
		$safeTitle = 'index'; // Default value
		if(isset($_GET['page'])) {
			$unsafe = $_GET['page'];
			$filter = array('.', '/', '\\');
			$safeTitle = str_replace($filter, '', $unsafe);
		}
		return $safeTitle;
	}

?>