jQuery.noConflict();
jQuery(function(){ jQuery('.tips').tipsy({gravity: 's',html: true}); });
jQuery(function(){ jQuery('.tips-right').tipsy({gravity: 'w',html: true}); });
jQuery(function(){ jQuery('.tips-left').tipsy({gravity: 'e',html: true}); });
jQuery(function(){ jQuery('.tips-bottom').tipsy({gravity: 'n',html: true}); });



/* Ie7 z-index fix */
jQuery(function() {
    var zIndexNumber = 1000;
    jQuery('div').each(function() {
        jQuery(this).css('zIndex', zIndexNumber);
        zIndexNumber -= 10;
    });
});



/* Form Style */
jQuery(function(){

jQuery(".st-forminput").focus(function(){

jQuery(this).attr('class','st-forminput-active ');

});

jQuery(".st-forminput").blur(function(){

jQuery(this).attr('class','st-forminput');

});

});




/* Login Input Form */
jQuery(function(){

jQuery(".login-input-pass").focus(function(){

jQuery(this).attr('class','login-input-pass-active ');

});

jQuery(".login-input-pass").blur(function(){

jQuery(this).attr('class','login-input-pass');

});

});
jQuery(function(){

jQuery(".login-input-user").focus(function(){

jQuery(this).attr('class','login-input-user-active ');

});

jQuery(".login-input-user").blur(function(){

jQuery(this).attr('class','login-input-user');

});

});




///* Uniform */
//      jQuery(function(){
//        jQuery(".uniform").uniform();
//      });
//
//
///* jWYSIWYG editor */
//  jQuery(function()
//  {
//      jQuery('#wysiwyg').wysiwyg();
//  });
//
//
///* Table Shorter */
//jQuery(document).ready(function() 
//    { 
//        jQuery("#myTable").tablesorter(); 
//    } 
//); 
//



/* Full Calendar */

	jQuery(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		jQuery('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
		
	});




/* iphone style switches */
	jQuery(document).ready( function(){ 
		jQuery(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			jQuery('.cb-disable',parent).removeClass('selected');
			jQuery(this).addClass('selected');
			jQuery('.checkbox',parent).attr('checked', true);
		});
		jQuery(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			jQuery('.cb-enable',parent).removeClass('selected');
			jQuery(this).addClass('selected');
			jQuery('.checkbox',parent).attr('checked', false);
		});
	});


