			<article class="liveShow postText">
				<div class="liveDate"><?php echo date('Y, M j', strtotime($this->showDate)); ?></div>
				<div class="livePlace"><?php echo $this->country, ', ', $this->city; ?></div>
				<div class="liveVenue"><a href="#" id="showDetails<?php echo $this->showDate; ?>"><?php echo $this->venue; ?></a></div>
				<div class="liveBands"><?php echo $this->otherBandsList; ?></div>
				<div class="clear"></div>
			</article>
            <!-- Element to pop up -->
            <div id="liveShowDetails<?php echo $this->showDate; ?>">
				<p class="red">(Close by clicking outside this box)</p>
				<h3>Setlist</h3>
				<ol>
			<?php 
				if(!empty($this->setlist)) {
					foreach($this->setlist as $song) {
						echo '<li>', $song['title'], '</li>';
					}
				} else {
					echo 'TBD';
				}
			?>
				</ol>
				<h3>Performers</h3>
			<?php
				if(!empty($this->performers)) {
					foreach($this->performers as $guy) {
						echo '<p class="indent">', $guy['name'], ' - ', $guy['instrument'], '</p>';
					}
				} else {
					echo 'TBA';
				}
			?>
				<h3>Comments</h3>
					<p class="indent"><?php if(!empty($this->comments)) { echo $this->comments; } ?></p>
			</div>
