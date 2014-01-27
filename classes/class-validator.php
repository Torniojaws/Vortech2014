<?php
	
	class Validator {
		private $unsafeData;
		private $safeData;
		private $disallowedCharacters;
		private $linebreaks;
		
		public function __construct($unsafeData) {
			$this->unsafeData = $unsafeData;
			$this->disallowedCharacters = array('|');
			$this->linebreaks = array("\r\n", "\r", "\n");
			$this->makeDataSafe();
		}
		
		private function makeDataSafe() {
			if(is_array($this->unsafeData)) {
				foreach($this->unsafeData as $temp) {
					$temp = $this->makeSafe($temp);
					$this->safeData[] = $temp;
				}
			} else {
				$this->safeData = $this->makeSafe($this->unsafeData);
			}
		}
		
		private function makeSafe($input) {
			$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
			$input = str_replace($this->linebreaks, '<br />', $input);
			$input = str_replace($this->disallowedCharacters, '', $input);
			return $input;
		}
		
		public function getSafeData() {
			if(empty($this->safeData)) {
				die('No data returned!');
			} else {
				return $this->safeData;
			}
		}
	}
	
?>