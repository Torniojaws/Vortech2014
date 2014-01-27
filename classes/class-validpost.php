<?php
	include('class-guestbook.php'); // To get the next free index number in datafile
	include('class-mydate.php');
	
	class ValidPost {
		public $unformatted;
		private $delimitedString;
		private $nextIndex;
		private $delimiter;
		
		public function __construct($array, $delimiter) {
			array_pop($array); // Remove last item in array, it is POST Submit
			$this->unformatted = $array;
			$this->delimiter = $delimiter;
			$nextFreeIndex = new Guestbook('../contents/datafiles/guestbook/book.txt');
			$this->nextIndex = $nextFreeIndex->getNextIndex();
			$this->createString();
		}
		
		public function getPost() {
			return $this->delimitedString;
		}
		
		private function createString() {
			list($name, $antispam, $antispamIndex, $message) = array_values($this->unformatted);
			$time = new MyDate('Y-m-d H:i');
			$this->delimitedString = $this->nextIndex.$this->delimiter;
			$this->delimitedString .= $name.$this->delimiter;
			$this->delimitedString .= $message.$this->delimiter;
			$this->delimitedString .= $time->getDate() . $this->delimiter . PHP_EOL;
			echo $this->delimitedString;
		}
	}
	
?>