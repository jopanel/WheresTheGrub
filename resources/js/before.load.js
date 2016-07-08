var $ = jQuery.noConflict();
var navigationStyle;
$(document).ready(function($) {
    "use strict";

    var $body = $('body');

  
});

$(window).resize(function(){
    mobileNavigation();
});

// Navigation on small screen ------------------------------------------------------------------------------------------

function mobileNavigation(){
    if( $(window).width() < 979 ){
        //$(".main-navigation.navigation-top-header").remove();
        $(".main-navigation.navigation-top-header").css("display","none");
        $(".toggle-navigation").css("display","inline-block"); 
        $("body").removeClass("navigation-top-header");
        $("body").addClass("navigation-off-canvas");		
    }
	else {	
		if( navigationStyle == "topHeader" ){ 
			$("body").removeClass("navigation-off-canvas");
			$("body").addClass("navigation-top-header");
			$(".main-navigation.navigation-top-header").css("display","inline-block");
			$(".toggle-navigation").css("display","none");
		} 		
	}
}

// Toggle off canvas navigation ----------------------------------------------------------------------------------------

$('.header .toggle-navigation').on( "click", function() {
	//console.log("click");
	$('#outer-wrapper').toggleClass('show-nav');
});

$('#page-content').on( "click", function() {
	if( $('body').hasClass('navigation-off-canvas') ){
		$('#outer-wrapper').removeClass('show-nav');
	}
}); 
