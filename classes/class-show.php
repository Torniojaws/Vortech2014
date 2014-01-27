<?php

	class Show {
		private $artist;
		public $showDate;
		private $venue;
		private $city;
		private $country;
		private $performers = array();
		private $setlist = array();
		private $otherBands = array();
		private $otherBandsList;
		private $comments;
		
		public function __construct($jsonFile) {
			if(empty($jsonFile)) {
				echo 'No data in json!';
			} else {
				$json = file_get_contents($jsonFile);
				$show = json_decode($json, true);
				// Properties
				$this->artist = $show['artist'];
				$this->showDate = $show['date'];
				$this->venue = $show['venue'];
				$this->city = $show['city'];
				$this->country = $show['country'];
				$this->performers = $show['performers'];
				$this->setlist = $show['setlist'];
				$this->otherBands = $show['otherBands'];
				$this->comments = $show['comments'];
				$this->otherBandsList = $this->generateListOfOtherBands();
			}
		}
		
		public function display() {
			include('templates/vortech/liveshow.php');
		}
		
		private function generateListOfOtherBands() {
			if($this->showHadOtherBands() == true) {
				return $this->buildString();
			}
		}
		
		private function showHadOtherBands() {
			if(empty($this->otherBands[0]['name'])) {
				return false;
			} else {
				return true;
			}
		}
		
		private function buildString() {
			$counter = 1;
			$listInHtml = "";
			foreach($this->otherBands as $band) {
				$listInHtml .= $this->createLink($band);
				$listInHtml .= $this->addCommaWhenNeeded($counter);
				++$counter;
			}
			return $listInHtml;
		}
		
		private function createLink($band) {
			if(empty($band['website'])) {
				return $band['name'];
			} else {
				return '<a href="' . $band['website'] . '">' . $band['name'] . '</a>';
			}
		}
		
		private function addCommaWhenNeeded($counter) {
			if($this->isLastItem($counter) == false) {
				return ', ';
			}
		}
		
		private function isLastItem($counter) {
			if($counter < count($this->otherBands)) {
				return false;
			} else {
				return true;
			}
		}
	}
	
?>