
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
    $('#ro_first_name').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable",
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

     $('#ro_last_name').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable",
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

         $('#ro_sex').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable",
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
             $('#ro_birthday').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable",
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
        $('#ro_civil_status').editable({
    		disabled:true, 
    		url: "http://localhost/icdrris/ResponseOrg/testEditable",
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
	    $('#members').find('.btn-success').hide();
	    $('#members').find('.edit').show();
	    $(this).hide().siblings('.btn-success').show();
	    $('#members').find('.editable').editable('toggleDisabled');
	});

	$('.btn-success').on('click', function() {
	    var $btn = $(this);
	    $('#members').find('.editable').editable('toggleDisabled');
	    $btn.hide().siblings('.edit').show();
	});

});