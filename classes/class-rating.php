<?php

	require_once('res/defines.php');
	/*
		Def requires RATINGPATH
		
	*/

	class Rating {
		private $ratingId;
		private $maximumRating;
		private $currentRating;
		private $sumOfVotes;
		private $votesGiven;
		private $goldStarWidth;
		private $maxWidth;
		private $filepath;
		
		public function __construct($max) {
			if(is_numeric($max)) {
				$this->maximumRating = $max;
			}
			$this->goldStarWidth = 27; // 27 = width of one Golden Star image in px
			$this->maxWidth = $this->goldStarWidth * $this->maximumRating;
		}
		
		public function showCurrent($id) {
			$this->ratingId = $id;
			$finalScore = $this->countRating();
		}
		
		public function getScore() {
			return round($this->currentRating, 2);
		}
		
		public function getMaxRating() {
			return $this->maximumRating;
		}
		
		public function getVotes() {
			return $this->votesGiven;
		}
		
		public function displayHtml() {
			if($this->getScore() == 0) {
				echo 'No votes! Give yours!';
			} else {
				echo '<span class="albumStarsRating">';
				echo $this->getScore();
				echo ' / ';
				echo $this->getMaxRating();
				echo '</span> fan rating (';
				echo $this->getVotes();
				echo ' votes)';
			}
		}
		
		private function countRating() {
			$this->filepath = RATINGPATH.$this->ratingId.".txt";
			if(!file_exists($this->filepath)) {
				$this->createRatingFile();
			}
			$datafile = file($this->filepath);
			if(isset($datafile[1]) && $datafile[1] > 0) {
				$this->sumOfVotes = $datafile[0];
				$this->votesGiven = $datafile[1];
				$this->currentRating = $this->sumOfVotes / $this->votesGiven;
				return $this->currentRating;
			} else {
				$this->currentRating = 'N/A - no votes yet';
			}
		}
		
		private function display($score) {
			$width = $score * $this->goldStarWidth;
			if($width > $this->maxWidth) {
				$width = $this->maxWidth;
			}
			echo '<div class="albumGoldStar" style="width:';
			echo $width;
			echo 'px;"></div>';
		}
		
		private function createRatingFile() {
			$fp = fopen($this->filepath, 'w');
			fclose($fp);
		}
	}
	
?>