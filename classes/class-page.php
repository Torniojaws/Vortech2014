<?php

	class Page {
		private $pageTitle;
		private $cssFile;
		private $pageContentFile;
		
		public function __construct($pageTitle=null, $cssFile=null) {
			$this->pageTitle = $pageTitle;
			$this->cssFile = $cssFile;
			$this->pageContentFile = $pageTitle . ".php";
		}
	
		public function display($template) {
			include($template . 'page.php');
		}
	}
	
?>