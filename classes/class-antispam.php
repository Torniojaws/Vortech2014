<?php
	include_once(dirname(__DIR__).'/res/defines.php');
	
	class Antispam {
		private $datafile;
		private $countQuestions;
		private $index;
		
		public function __construct() {
			$this->datafile = ROOTPATH.'/contents/datafiles/antispam/antispam.txt';
			$this->countQuestions = count(file($this->datafile));
			$this->index = $this->randomNumber();
		}
		
		public function getQuestion() {
			$questions = file($this->datafile);
			$currentRow = $questions[$this->index];
			list($question, $answer) = explode('|', $currentRow);
			return $question;
		}
		
		public function getIndex() {
			return $this->index;
		}
		
		public function answerIsCorrect($unsafeAnswer, $index) {
			if(empty($unsafeAnswer)) {
				return false;
			}
			$data = file($this->datafile);
			list($question, $answer) = explode('|', $data[$index]);
			if($unsafeAnswer == $answer) {
				return true;
			} else {
				return false;
			}
		}
		
		private function randomNumber() {
			return rand(0, $this->countQuestions - 1);
		}
	}
	
?>