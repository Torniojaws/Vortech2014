<?php

	class NewsComment {
		public $newsPostId; // Ties this NewsComment into a given NewsPost
		private $poster;
		private $comment;
		private $postedDate;
		
		public function __construct($rawData) {
			if(empty($rawData)) {
				echo 'No data in comment!';
			} else {
				$array = explode('|', $rawData);
				$this->newsPostId = $array[0];
				$this->poster = $array[1];
				$this->comment = $array[2];
				$this->postedDate = $array[3];
			}
		}
		
		public function display() {
			include('templates/vortech/newscomment.php');
		}
	}
	
?>