<h2>News</h2>
<?php
	include('classes/class-newssystem.php');
	
	// Setup
	$datafile = 'contents/datafiles/news/news.txt';
	$commentDatafile = 'contents/datafiles/news/comments.txt';
	$postsPerPage = 5;
	$sorting = 'newest';
	
	// Admin can add new posts, when logged in
	if(isset($_SESSION['adminLoginStatus']) && $_SESSION['adminLoginStatus'] == 'loginOK') {
		$newPost = new Form('contents/addNews.php', 'adminForm');
		$newPost->addCaption('Title');
		$newPost->addTextInput('newsTitle');
		$newPost->addCaption('Message');
		$newPost->addTextarea('newspost');
		$newPost->addSubmit('newsSubmit', 'Send');
		$newPost->ready();
		echo '<hr />';
	}
	
	// News
	$news = new NewsSystem($datafile, $commentDatafile, $postsPerPage, $sorting);
	$news->showNewsPosts();
	
?>
			<nav class="newsPaginationNav">
<?php $news->showPagination(); ?>
			</nav>
			<div class="clear"></div>
