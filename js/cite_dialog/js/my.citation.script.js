/*!
 * bilal iscimen
 */
$(function() {
	var s = 0;
	$('#citation-area').focus(function() {
		var $this = $(this);

		$this.select();

		window.setTimeout(function() {
			$this.select();
		}, 1);

		// Work around WebKit's little problem
		function mouseUpHandler() {
			// Prevent further mouseup intervention
			$this.off("mouseup", mouseUpHandler);
			return false;
		}

		$this.mouseup(mouseUpHandler);
	});

	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 300,
		width: 550,
		modal: true,
		buttons: {
			Close: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			$("#citation-area").val("");
			s = 0;
		}
	});

	$(document).click(function() {
		var dialogAcik = $("#dialog-form").dialog( "isOpen" );
		if(dialogAcik == true) {
			s = s + 1;
			if(s>1) {
				$("#dialog-form").dialog( "close" );
				s = 0;
			}
		}
	});

	$("#dialog-form").click(function(e) {
		e.stopPropagation(); // This is the preferred method.
		return false;        // This should not be used unless you do not want
							// any click events registering inside the div
	});

});

function open_citation(citation){
	$("#citation-area").val(citation);
	$("#dialog-form").dialog( "open" );
}