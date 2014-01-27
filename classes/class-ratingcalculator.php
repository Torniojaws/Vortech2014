<?php

	class RatingCalculator {
		private $targetFile;
		private $oldRating;
		private $oldVoteCount;
		private $newRating;
		private $newVoteCount;
		private $finalData;
		private $debug = 1;
		
		public function __construct($file) {
			echo 'KUTSUTTIIN RATING';
			$this->targetFile = $file;
			$contents = file($this->targetFile);
			if(empty($contents)) {
				$this->oldRating = 0;
				$this->oldVoteCount = 0;
			} else {
				$this->oldRating = $contents[0];
				$this->oldVoteCount = $contents[1];
			}
		}
		
		public function add($newRating) {
			$this->createRating($newRating);
			$this->incrementVoteCounter();
			$this->createFinalData();
			$this->writeNewData();
		}
		
		private function createRating($new) {
			$this->newRating = $this->oldRating + $new;
		}
		
		private function incrementVoteCounter() {
			$this->newVoteCount = $this->oldVoteCount + 1;
		}
		
		private function createFinalData() {
			$this->finalData = $this->newRating. PHP_EOL .$this->newVoteCount;
		}
		
		private function writeNewData() {
			$fp = fopen($this->targetFile, 'w');
			if(flock($fp, LOCK_EX)) {
				usleep(rand(1, 10000));
				fwrite($fp, $this->finalData);
				flock($fp, LOCK_UN);
			} else {
				echo 'Rating: Could not get lock to file - writing cancelled!';
			}
			fclose($fp);
		}

	}
	
?>