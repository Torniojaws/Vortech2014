<article class="guestbookPost">
	<header class="titlebox">
		<p class="titleboxText"><span class="bold"><?php echo $this->poster; ?></span> | <?php echo date('j M Y, H:i', strtotime($this->postedDate)); ?></p>
	</header>
	<div class="postText">
		<p><?php echo htmlspecialchars_decode($this->message); ?></p>
		<p class="adminComment">
		<?php
			if(isset($this->adminComment[2])) {
				echo $this->adminComment;
			} else if(isset($_SESSION['adminLoginStatus']) && $_SESSION['adminLoginStatus'] == 'loginOK') {
				echo '&raquo; <a href="contents/addGuestbookComment.php?id=', $this->id, '">Add Comment</a>';
			}		
		?>
		</p>
	</div>
</article>
