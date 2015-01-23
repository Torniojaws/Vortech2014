			<article class="newsPost">
				<header class="newsTitleBox">
					<h3 class="newsTitleText"><?php echo $this->title; ?></h3>
					<p class="newsDateText"><?php echo date('j M Y', strtotime($this->postedDate)); ?>
					<?php 
						if(isset($_SESSION['adminLoginStatus']) && $_SESSION['adminLoginStatus'] == 'loginOK') {
							echo '<a href="?page=editNews&amp;id=', $this->id,'&amp;reference=news">Edit</a>';
						} ?></p>
				</header>
				<p class="newsPostText"><?php echo html_entity_decode($this->message); ?></p>
			</article>
