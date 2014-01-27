    ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('[id^=showDetails]').bind('click', function(e) {
                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
				var clickedId = $(this).attr('id');
				clickedId = clickedId.replace("showDetails", ''); // Remove "liveShowDetails" from string
				console.log(clickedId);
                $('#liveShowDetails' + clickedId).bPopup();

            });

        });
		
    })(jQuery);