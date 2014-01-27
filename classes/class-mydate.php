<?php

	class MyDate {
		private $timezone;
		private $format;
		private $currentTime;
		
		public function __construct($format) {
			$this->timezone = date_default_timezone_set('Europe/Helsinki');
			$this->format = $format;
		}
		
		public function getDate() {
			return date($this->format, time());
		}
	}

?>