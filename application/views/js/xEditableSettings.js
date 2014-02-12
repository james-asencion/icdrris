$.fn.editable.defaults.mode = 'inline';

$(document).ready(function(){
	$('#editMembersButton').click(function(e){
		e.stopPropagating();
		$('.members').editable('toggle');	
	});
	
});