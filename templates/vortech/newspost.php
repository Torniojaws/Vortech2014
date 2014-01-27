			<article class="newsPost">
				<header class="titlebox">
					<p class="titleboxText"><span class="bold"><?php echo $this->title; ?></span> | <?php echo date('j M Y, H:i', strtotime($this->postedDate)); ?>
					<?php 
						if(isset($_SESSION['adminLoginStatus']) && $_SESSION['adminLoginStatus'] == 'loginOK') {
							echo '<a href="?page=editNews&amp;id=', $this->id,'&amp;reference=news">Edit</a>';
						}
					?>
					</p>
				</header>
				<p class="postText"><?php echo $this->message; ?></p>
			</article>
