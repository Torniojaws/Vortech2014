<h3>Photos</h3>
				<script type="text/javascript">
				$(document).ready(function(){
					// Photo Gallery
					$('a[data-rel]').each(function() {
						$(this).attr('rel', $(this).data('rel'));
					}); // End each()
					$("a[rel^='prettyPhoto']").prettyPhoto();
					// Show albums in accordion
					$("#accordionAlbums").accordion({ // Requires jQuery UI plugin
						collapsible: true,
						heightStyle: "content"
					}); // End accordion()
				});
				</script>
				<div id="accordionAlbums">
<?php
	include('classes/class-photogallery.php');
	
	$data = 'contents/photoalbums/*.json';
	$galleries = new PhotoGallery($data);
	$galleries->display();
?>
				</div> <!-- End accordionAlbums -->
