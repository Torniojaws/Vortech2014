<?php

	class GuestbookPost {
		private $id;
		private $poster;
		private $message;
		private $postedDate;
		private $adminComment;
		
		public function __construct($rawData) {
			$array = explode('|', $rawData);
			$this->id = $array[0];
			$this->poster = $array[1];
			$this->message = $array[2];
			$this->postedDate = $array[3];
			if(!empty($array[4])) {
				$this->adminComment = $array[4];
			}
		}
		
		public function display() {
			include('templates/vortech/guestbookpost.php');
		}
	}
	
?>