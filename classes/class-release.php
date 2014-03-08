<?php

	class Release {
		public $artist;
		public $title;
		public $releaseDate;
		public $releaseCode;
		public $duration;
		public $downloadLink;
		public $studioReportId;
		public $recordingStartDate;
		public $recordingEndDate;
		public $isOnCD;
		public $tracklist = array();
		public $artwork = array();
		public $creditsFile;
		public $downloadCount;
		
		public function __construct($jsonFile) {
			$json = file_get_contents($jsonFile);
			$albumData = json_decode($json, true);
			if(!empty($albumData)) {
				$this->artist = $albumData['artist'];
				$this->title = $albumData['album'];
				$this->releaseDate = $albumData['releaseDate'];
				$this->releaseCode = $albumData['releaseCode'];
				$this->duration = $albumData['duration'];
				$this->downloadLink = $albumData['downloadLink'];
				$this->studioReportId = $albumData['studioReportId'];
				$this->recordingStartDate = $albumData['recordingStartDate'];
				$this->recordingEndDate = $albumData['recordingEndDate'];
				$this->isOnCD = $albumData['isOnCD'];
				$this->tracklist = $albumData['tracklist'];
				$this->artwork = $albumData['artwork'];
				$this->creditsFile = $albumData['creditsFile'];
				$this->downloadCount = $this->getDownloadCount();
			}
		}
		
		public function display() {
			include($_SESSION['template'] . 'release.php');
		}
		
		private function getDownloadCount() {
			$datafile = $this->downloadLink . "/count.dat";
			$contents = @file_get_contents($datafile);
			if(empty($contents)) {
				return 0;
			} else {
				return $contents;
			}
		}
	}
	
?>