/**
 * Common js
 */
/*(function ($) {
	'use strict';
  Drupal.behaviors.mytheme = {
		attach: function (context, settings) {
			jQuery('#edit-registration-type-1').click(function() {
			  jQuery(location).attr('href', Drupal.settings.basePath + 'recruiter/register');
			  jQuery(this).attr('checked',true);	
			});
			jQuery('#edit-registration-type-0').click(function() {
			  jQuery(location).attr('href', Drupal.settings.basePath + 'user/register');
			  jQuery(this).attr('checked',true);			
			});
		}
  };
}(jQuery));*/


/*( function ($) {
'use strict';
  jQuery(document).ready(function() {
			// Minify the Nav Bar
			$(document).scroll(function () {
				var position = $(document).scrollTop();
				
				//console.log ('window' + $(window).scrollTop() );
				var headerHeight = $('#navbar').height();
				//console.log ( 'headerHeight' + headerHeight );
				if (position > 106){
						$('.navbar').addClass('minified');
				} else {
						$('.navbar').removeClass('minified');
				}
			});
   });
}(jQuery));*/
