<?php
	include('classes/class-newspost.php');
	include('classes/class-newscomment.php');
	include('classes/class-form.php');
	
	class NewsSystem {
		private $datafile;
		private $commentDatafile;
		private $postsPerPage;
		private $sorting;
		private $postCount;
		private $pageCount;
		public $newsposts;
		
		public function __construct($datafile=null, $commentDatafile=null, $postsPerPage=null, $sorting=null) {
			$this->datafile = $datafile;
			$this->commentDatafile = $commentDatafile;
			$this->newsposts = array_reverse(file($datafile, FILE_IGNORE_NEW_LINES));
			$this->postsPerPage = $postsPerPage;
			$this->sorting = $sorting;
			$this->postCount = $this->countPosts();
			$this->pageCount = ceil($this->postCount / $this->postsPerPage);
			$this->startIndex = $this->getStartIndex();
			// So that first page shows the correct amount of posts
			if($this->startIndex == 0) {
				$this->endIndex = $this->postsPerPage + 1;
			} else {
				$this->endIndex = $this->startIndex + $this->postsPerPage;
			}
		}
		
		public function showNewsPosts() {
			foreach($this->newsposts as $rawData) {
				$post = new NewsPost($rawData);
				if($post->id >= $this->startIndex && $post->id < $this->endIndex) {
					$post->display();
					$comments = $this->getCommentsFor($post->id);
				}
			}
		}
		
		public function showPagination() {
			for($i=1; $i<=$this->pageCount; ++$i) {
				echo "\t\t\t\t".'<a href="?page=index&amp;newsPage=', $i, '" class="newsPagination">', $i, '</a>', PHP_EOL;
			}
		}
		
		private function getStartIndex() {
			if(isset($_GET['newsPage']) && is_numeric($_GET['newsPage'])) {
				$startFromIndex = $this->postCount - ($_GET['newsPage'] * $this->postsPerPage) + 1;
			} else {
				$startFromIndex = $this->postCount - ($this->postsPerPage - 1); // Otherwise no posts are shown in main view
			}
			return $startFromIndex;
		}
		
		private function countPosts() {
			return count($this->newsposts);
		}
		
		private function getCommentsFor($id) {
			$commentsInFile = file($this->commentDatafile);
			$array = array();
			foreach($commentsInFile as $oneComment) {
				list($index) = explode('|', $oneComment);
				if($index == $id) {
					$array[] = $oneComment;
				}
			}
			return $array;
		}
	}
	
?>