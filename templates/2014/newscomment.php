			<article class="newsComment">
				<p class="postText commentId_<?php echo $this->newsPostId; ?>">
					<b><?php echo $this->poster; ?></b>: 
					   <?php echo $this->comment; ?> 
					  (<?php echo date('j M Y, H:i', strtotime($this->postedDate)); ?>)
				</p>
			</article>
