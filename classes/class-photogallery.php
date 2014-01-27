<?php
	include('classes/class-photoalbum.php');

	class PhotoGallery {
		private $albums;
		private $path;
		
		public function __construct($datafiles=null) {
			$files = glob($datafiles);
			foreach($files as $file) {
				$data = file_get_contents($file);
				$json = json_decode($data);
				$this->albums[] = $json;
			}
		}
		
		public function display() {
			foreach($this->albums as $album) {
				$pictures = new PhotoAlbum($album);
				$pictures->display();
			}
		}
	}
	
?>