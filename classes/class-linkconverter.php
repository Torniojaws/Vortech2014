<?php

	class LinkConverter {
		private $unprocessed;
		private $processed;
		
		public function __construct($unprocessed) {
			$this->unprocessed = $unprocessed;
		}
	
		public function getConvertedLinks() {
			$s = $this->unprocessed;
			return preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.-]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $s);
		}
	}
	
?>