
$(document).ready(function() {

	//$.fn.editable.defaults.mode = 'popover';
	//$('#firstname').editable({disabled:true});
	var defaults = {

	    disabled:true, 
	    showbuttons: true,
	    inputclass: 'input-small',  
	    url: "http://localhost/icdrris/Livelihood/testEditable"

	};
  
    $('#first_name').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#middle_name').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#last_name').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#sex').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#birthday').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#age').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#monthly_income').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#source_of_income').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#civil_status').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#no_of_children').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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

    $('#members span').editable({
    		placement:'right',
    		disabled:true, 
    		url: "http://localhost/icdrris/Livelihood/testEditable",
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
		$('#members').find('.editable-open').editable('hide');
	    $('#members').find('.btn-doneEdit').hide();
	    $('#members').find('.edit').show();
	    $(this).hide().siblings('.btn-doneEdit').show();
	    $('#members').find('.editable').editable('toggleDisabled');
	});

	$('.btn-doneEdit').on('click', function() {
	    var $btn = $(this);
	    $('#members').find('.editable').editable('hide');
	    $('#members').find('.editable').editable('toggleDisabled');
	    $btn.hide().siblings('.edit').show();
	});

});