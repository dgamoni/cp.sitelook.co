	


	jQuery(document).ready(function($){
		var login = $('#user_login').val();
		console.log(login);
		//$('#user_login').attr('name', 'user_login');
		$('#user_login').after('<input name="custom_login" value="'+login+'" autocomplete="off" type="hidden">');
	});
