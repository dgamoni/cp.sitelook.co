	


	jQuery(document).ready(function($){
		var login = $('#user_login').val();
		console.log(login);
		//$('#user_login').attr('name', 'user_login');
		$('#user_login').after('<input name="custom_login" value="'+login+'" autocomplete="off" type="hidden">');



		$('#loginform').before('<div class="login-header"><h2>Log in to your account</h2></div');
		$('#loginform .submit').before('<a href="http://cp.sitelook.co/wp-login.php?action=lostpassword" class="lost">Lost your password?</a>');
		//$('#loginform label[for="user_login"]').text('Username/Email');
		$('#lostpasswordform').before('<div class="login-header"><h2>Lost password</h2></div');
		$('#resetpassform').before('<div class="login-header"><h2>Set your password</h2></div');
	});
