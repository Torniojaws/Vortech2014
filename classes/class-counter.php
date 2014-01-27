<?php
	
	class Counter {
		private $currentCount;
		private $countFile;
		private $backupFile;
		
		public function __construct($file) {
			$this->countFile = $file;
			$this->backupFile = $file . ".bak";
			$this->createDatafilesIfNeeded();
			$this->currentCount = file_get_contents($this->countFile);
			$this->validate();
		}

		private function createDatafilesIfNeeded() {
			if(!file_exists($this->countFile)) {
				if(!file_exists($this->backupFile)) {
					$fp = fopen($this->countFile, 'w');
					fwrite($fp, '1');
					fclose($fp);
				} else { // Recover data from backup, if needed
					$fp = fopen($this->countFile, 'w');
					fwrite($fp, file_get_contents($this->backupFile));
					fclose($fp);
				}
			}
			// If backup doesn't exist, create it
			if(!file_exists($this->backupFile)) {
				$fp = fopen($this->countFile, 'w');
				fwrite($fp, $this->currentCount);
				fclose($fp);
			}
		}
		
		public function incrementPerSession() {
			if(isset($_SESSION['visitWritten'])) {
				echo $this->currentCount;
			} else {
				$count = $this->currentCount + 1;
				$this->writeNewCount($count);
				echo $count;
			}
		}
		
		private function writeNewCount($count) {
			$delay = rand(10000, 80000);
			$fp = fopen($this->countFile, 'w');
			if(flock($fp, LOCK_EX)) {
				usleep($delay);
				fwrite($fp, $count);
				flock($fp, LOCK_UN);
				$this->updateBackupFile($count);
				$_SESSION['visitWritten'] = true;
			} else {
				echo 'Counter: Could not write to file';
			}
			fclose($fp);
		}
		
		private function validate() {
			$dataToBeChecked = $this->currentCount;
			$backupData = file_get_contents($this->backupFile);
			if($dataToBeChecked < $backupData || $dataToBeChecked == NULL) {
				$this->currentCount = $backupData;
			}
		}
		
		private function updateBackupFile($count) {
			$bup = fopen($this->backupFile, 'w');
			if(flock($bup, LOCK_EX)) {
				fwrite($bup, $count);
			 	flock($bup, LOCK_UN);
				fclose($bup);
			}
		}
	}
?>