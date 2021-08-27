function goscroll(next, currentNowprev){
	if(next != "null"){
		//Scroll
		$('html, body').animate({
		    scrollTop: $("#"+next).offset().top,
		}, 2000);

		//Remove background Ash
		$("#"+next+" > div").removeClass('bg-ash');

		//Enable State Fields
		$("."+next+"_field").each(function(i, obj) {
		    //loop through each class and activate field
		    $(this).prop('disabled', false);
		});		

	}

	$("."+next+"_myloader").hide();

	// Replace loader
	$("."+currentNowprev+"_myloader").show();

	$("."+currentNowprev+"_field").each(function(i, obj) {
	    //loop through each class and deactivate field
	    // Replace loader
	    $(this).prop('disabled', true);
	    $("."+currentNowprev+"_def").addClass('bg-ash');
	});


	  $("."+next+"_myloader").toggleClass('load-complete');
	  $("."+currentNowprev+"_checkmark.draw").each(function(i, obj){
	  		$(this).css("display", "block");
	  });	

}



