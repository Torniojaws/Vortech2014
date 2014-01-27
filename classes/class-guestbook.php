<?php
	include('class-guestbookpost.php');
	
	class Guestbook {
		private $datafile;
		private $bookData;
		private $postObjects;
		private $nextAvailableIndex;
		
		public function __construct($datafile) {
			$this->datafile = $datafile;
			$this->bookData = file($this->datafile);
			// So that the newest post will be first
			natsort($this->bookData); 
			$this->bookData = array_reverse($this->bookData);			
			$this->nextAvailableIndex = count($this->bookData) + 1;
			foreach($this->bookData as $rawData) {
				$this->postObjects[] = new GuestbookPost($rawData);
			}
		}
		
		public function show() {
			foreach($this->postObjects as $post) {
				$post->display();
			}
		}
		
		public function getNextIndex() {
			return $this->nextAvailableIndex;
		}
	}
	
?>