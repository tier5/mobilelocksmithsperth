// JavaScript Document
jQuery(document).ready(function(){


	
$('#nav').affix({
      offset: {
        top: $('.header_top').height()
      }
});	
/*--------------Banner--------------*/
$('#banner_slide').carousel();
/*------------------------*/

	/*	
$('#sidebar').affix({
      offset: {
        top: 200
      }
});	
*/

if($(window).width()>769){
        $('.navbar .dropdown').hover(function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

        }, function() {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

        });

        $('.navbar .dropdown > a').click(function(){
            location.href = this.href;
        });

    }





		/*For Toggle icon*/	
	jQuery("#res-nav-btn").click(function(){
if(!jQuery("#res-nav-btn").hasClass("collapsed")){
jQuery("#res-nav-btn").find("span:nth-child(3)").removeClass("middle-bar");
jQuery("#res-nav-btn").find("span:nth-child(2)").removeClass("fast-bar");
jQuery("#res-nav-btn").find("span:nth-child(4)").removeClass("last-bar");

}
else if(jQuery("#res-nav-btn").hasClass("collapsed")){
jQuery("#res-nav-btn").find("span:nth-child(3)").addClass("middle-bar");
jQuery("#res-nav-btn").find("span:nth-child(2)").addClass("fast-bar");
jQuery("#res-nav-btn").find("span:nth-child(4)").addClass("last-bar");
}
});
/*----------------------------------Scroll---Top-----------------------------*/			
// Only enable if the document has a long scroll bar
// Note the window height + offset
if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}
});