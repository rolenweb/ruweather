$(function() {
	$( ".container" ).on('focus', 'input[name = "search"]',function( event ) {

		var form = $(this).parents('form[name = "search-city"]');
		
	  	$(this).autocomplete({
	  		
            source: function( request, response ) {
            	//console.log('test');
	            $.ajax({
	                url: "/site/autocomplete-city",
	                dataType: "json",
	                data: {
	                    q: request.term,
	                    fd: form.serializeArray()
	                },
	                success: function( data ) {
	                	
	                	//response( data );
	                	response($.map(data, function(item){
			              return{
			                label: item.label,
			                value: item.value,
			                id: item.id
			              }
			            }));
	                }
	            });
        	},
            
            minLength: 3,
            delay: 5,
            select: function( event, ui ) {
               // console.log(ui.item.id);
                /*$.post(
			        '/account-managers/show-list-items-invoice-contract-report',
			        {
			        	id: ui.item.id,
			        	form: form.serializeArray()
			        },
			        function (data) {
			            list_item.html(data);
			            
			    });*/
            },
            open: function() {
                $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" )
            },
            close: function() {
                $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            },

        });  

        //$(this).autocomplete( "search", "" );
	});
});