<?php

	class NewsPost {
		public $id;
		private $poster;
		private $title;
		private $message;
		private $postedDate;
		
		public function __construct($rawData=null) {
			if(empty($rawData)) {
				echo 'No data in NewsPost!';
			} else {
				$array = explode('|', $rawData);
				$this->id = $array[0];
				$this->poster = $array[1];
				$this->title = $array[2];
				$this->message = $array[3];
				$this->postedDate = $array[4];
			}
		}
		
		public function display() {
			include($_SESSION['template'] . 'newspost.php');
		}
	}
	
?>