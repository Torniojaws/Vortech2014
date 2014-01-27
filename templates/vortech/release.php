<article class="albumRating">
	<header class="titlebox">
		<p class="titleboxText"><span class="bold"><?php echo $this->title; ?></span> | <?php echo date('Y, M j', strtotime($this->releaseDate)); ?></p>
	</header>
	<div id="popup"></div> <!-- Lyrics and Studio report will be in this div after loading with jQuery -->
	<div class="postText">
		<img src="contents/<?php echo $this->artwork[0]['front']; ?>.jpg" alt="<?php echo $this->title; ?>" class="floatLeft albumBorder extraMargin" />
		<ol class="floatLeft releaseTracklist">
			<?php foreach($this->tracklist as $track) { ?>
				<li><?php echo $track['trackTitle']; ?> 
				<?php if(!empty($track['trackTabFile'])) { ?>
					<span class="siteBlue">&raquo;</span> 
					<a href="contents/tabs/<?php echo $track['trackTabFile']; ?>">Guitar Pro tab</a></li>
				<?php } // End if ?>
			<?php } // End foreach ?>
		</ol>
		<div class="clear"></div>
		<?php
			// Add golden stars to release, equal to its current score
			$rating = new Rating(5);
			$rating->showCurrent($this->releaseCode); 
		?>
		<div data-productid="<?php echo $this->releaseCode; ?>" class="rateit bigstars" data-rateit-resetable="false" data-rateit-starwidth="27" data-rateit-starheight="25" data-rateit-value="<?php echo $rating->getScore(); ?>" data-rateit-ispreset="true"></div>
		<?php $rating->displayHtml(); ?>
		<p>
			<a href="<?php echo $this->downloadLink; ?>">Download</a> (<?php echo $this->downloadCount; ?> downloads) | 
			<a href="contents/articles/<?php echo $this->studioReportId; ?>.php" id="studio<?php echo $this->studioReportId; ?>">Studio Report</a> | 
			<a href="contents/lyrics/<?php echo $this->releaseCode; ?>.php" id="lyrics<?php echo $this->releaseCode; ?>">Lyrics</a> | 
			Duration: <?php echo $this->duration; ?>
		</p>
		<section class="albumCredits">
			<?php include("contents/" . $this->creditsFile); ?>
		</section>
	</div>
</article>