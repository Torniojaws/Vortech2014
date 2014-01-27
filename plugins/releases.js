/* Releases jQuery v1.0 */
/* Open lyrics and studio reports into a bPop modal window */

$(document).ready(function() {
	$('[id^=studio], [id^=lyrics]').click(function(event) {
		event.preventDefault();
		var clickedId = $(this).attr('id');
		if(clickedId.substring(0, 6) == "studio") {
			var replaceThis = "studio";
			var path = "contents/articles/";
		} else {
			var replaceThis = "lyrics";
			var path = "contents/lyrics/";
		}
		clickedId = clickedId.replace(replaceThis, '');
		var scrollPosition = $(document).scrollTop();
		$('#popup').load(path + clickedId + '.php').bPopup({
			follow: [false, false],
			position: ['auto', scrollPosition],
			onClose: function() { $('html, body').animate({scrollTop: scrollPosition}, "fast"); }
		});
	});
});