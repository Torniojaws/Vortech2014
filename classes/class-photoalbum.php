<?php
	include('classes/class-photo.php');
	
	class PhotoAlbum {
		private $path;
		private $title;
		private $coverPhoto;
		private $pictures;
		
		public function __construct($object) {
			$this->title = $object->title;
			$this->coverPhoto = $object->cover;
			$this->path = $object->folder;
			foreach($object->photos as $pic) {
				$this->pictures[] = $pic;
			}
		}
		
		public function display() {
			include($_SESSION['template'] . 'photoalbum.php');
			foreach($this->pictures as $photo) {
				$picture = new Photo($photo, $this->path);
				$picture->display();
			}
			include($_SESSION['template'] . 'photoalbumEnd.php');
		}
	}
	
?>