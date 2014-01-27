<?php

	class Writer {
		private $file;
		private $writeOk;
		
		public function __construct($file=null) {
			if(file_exists($file)) {
				$this->file = $file;
			} else {
				$this->createFile($file);
			}
			$this->writeOk = false;
		}
		
		public function add($data, $mode) {
			$fp = fopen($this->file, $mode);
			if(flock($fp, LOCK_EX)) {
				usleep(rand(1, 10000));
				fwrite($fp, $data);
				flock($fp, LOCK_UN);
				fclose($fp);
				$this->writeOk = true;
			}
		}
		
		public function writeOk() {
			return $this->writeOk;
		}
		
		private function createFile($file) {
			$fp = fopen($file, 'w');
			fclose($fp);
			$this->file = $file;
		}
	}
	
?>