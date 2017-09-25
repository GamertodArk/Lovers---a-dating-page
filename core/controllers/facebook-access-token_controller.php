<?php 
	if (isset($_GET['redirect'])) {

		if (! session_id()) {session_start();}

		include 'core/facebook/facebook_get_accessToken.php';


		if ($_GET['redirect'] === 'login') {
			// Redireccion al unicio de sesion con facebook
			header('location: facebook-login');

		}else if ($_GET['redirect'] === 'signup') {
			// Redireccion al registr con facebook
			header('location: facebook-signup');
		}

	}else {
		header('location: home');
	}
	
?>