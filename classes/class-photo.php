<?php

	class Photo {
		private $filename;
		private $thumbnail;
		private $caption;
		private $path;
		
		public function __construct($json, $filepath) {
			$this->path = 'contents/photoalbums/'.$filepath.'/';
			$this->filename = $json->url;
			$this->thumbnail = $json->thumb;
			$this->caption = $json->caption;
		}
		
		public function display() {
			include($_SESSION['template'] . 'photoOne.php');
		}
	}
	
?>