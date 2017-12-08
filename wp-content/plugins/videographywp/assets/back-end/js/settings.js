/**
 * 
 */
;(function($){
	
	$(document).ready(function(){
		// tabs
		$.each( $('.cvwp-tabs'), function(){
			var storageVar 	= $(this).data('storage_var'),
				allowed		= typeof(Storage) !== 'undefined';
			
			if( !storageVar || !allowed ){
				var data = {};
			}else{
				var data = {
					active : sessionStorage[ storageVar ],
					activate : function( event, ui ){
						$(ui.newTab).find('i')
							.removeClass('dashicons-arrow-right')	
							.addClass('dashicons-arrow-down');
						
						$(ui.oldTab).find('i')
							.addClass('dashicons-arrow-right')	
							.removeClass('dashicons-arrow-down');
						
						sessionStorage[ storageVar ] = ui.newTab.index();
					},
					create: function(event, ui){
						$(ui.tab).find('i')
							.removeClass('dashicons-arrow-right')	
							.addClass('dashicons-arrow-down');
					}
				};
			}			
			$(this).tabs( data );
		});
		
		// end tabs
		
		var checkbox = $('.toggler').find('input[type=checkbox]');
		$.each(checkbox, function(i, ch){
			var tbl 		= $(this).parents('table'),
				selector 	= $(this).data('selector'),
				tr 	= selector ? $(tbl).find(selector) : $(tbl).find('tr.toggle'),
				on 	= $(this).data('action_on') || 'show';
			
			if( !$(this).is(':checked') ){
				if( 'show' == on ){
					$(tr).hide();
				}	
			}else{
				if( 'hide' == on ){
					$(tr).hide();
				}
			}	
			
			$(this).click(function(){
				if( $(ch).is(':checked') ){
					if( 'show' == on ){
						$(tr).show(400);
					}else{
						$(tr).hide(200);
					}	
				}else{
					if( 'show' == on ){
						$(tr).hide(200);
					}else{
						$(tr).show(400);
					}	
				}
			});
			
		});
		
	});
	
})(jQuery);