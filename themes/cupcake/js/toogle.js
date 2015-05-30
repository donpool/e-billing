jQuery.noConflict();/* Stats Toogle */
jQuery(document).ready(function(){
  jQuery("#open-stats, #stats .close").click(function(){
    jQuery("#stats").slideToggle()
  });
});


/* Simple Tips */
jQuery(document).ready(function(){
  jQuery(".simple-tips .close").click(function(){
    jQuery(".simple-tips").slideToggle()
  });
});




/* ALERT AND DIALOG BOXES */
//<![CDATA[    
   // START ready function
   jQuery(document).ready(function(){
 
	// TOGGLE SCRIPT
 
	jQuery(".albox .close").click(function(event){
		$(this).parents(".albox").slideToggle();
 
		// Stop the link click from doing its normal thing
		return false;
	}); // END TOGGLE
 
   }); // END ready function
 //]]>



//<![CDATA[    
   // START ready function
   jQuery(document).ready(function(){
 
	// TOGGLE SCRIPT
 
	jQuery(".toggle-message .title, .toggle-message p").click(function(event){
		$(this).parents(".toggle-message").find(".hide-message").slideToggle();
 
		// Stop the link click from doing its normal thing
		return false;
	}); // END TOGGLE
 
   }); // END ready function
 //]]>





/* SUBMENU */
//<![CDATA[    
   // START ready function
   jQuery(document).ready(function(){
 
	// TOGGLE SCRIPT
	jQuery(".subtitle .action").click(function(event){
		jQuery(this).parents(".subtitle").find(".submenu").slideToggle();
 
		// Stop the link click from doing its normal thing
		return false;
	}); // END TOGGLE
 
   }); // END ready function
 //]]>


