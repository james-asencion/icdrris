$(document).ready(function() {

	//$.fn.editable.defaults.mode = 'popover';
	//$('#firstname').editable({disabled:true});
	var defaults = {

	    disabled:true, 
	    showbuttons: true,
	    inputclass: 'input-small',  
	    url: "http://localhost/icdrris/ResponseOrg/testEditable"

	};


 	$('#members1 span').editable({
    		placement:'right',
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable2",
    		validate: function(value) {
			    if($.trim(value) == '') {
			        return 'This field is required';
			    }
			},
    		error: function(response, newValue) {
			    if(response.status === 500) {
			        return 'Name already exists.';
			    } else {
			        return response.responseText;
			    }
			}
    });

    $('.edit').on('click', function(){
		$('#members1').find('.editable-open').editable('hide');
	    $('#members1').find('.btn-doneEdit').hide();
	    $('#members1').find('.edit').show();
	    $(this).hide().siblings('.btn-doneEdit').show();
	    $('#members1').find('.editable').editable('toggleDisabled');
	});

	$('.btn-doneEdit').on('click', function() {
	    var $btn = $(this);
	    $('#members1').find('.editable').editable('hide');
	    $('#members1').find('.editable').editable('toggleDisabled');
	    $btn.hide().siblings('.edit').show();
	});

});