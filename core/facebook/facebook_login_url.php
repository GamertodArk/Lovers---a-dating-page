<?php  
	$fb = new Facebook\Facebook([
			'app_id' 	 => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			'persistent_data_handler' => 'session'
		]);

	$helper = $fb->getRedirectLoginHelper();

	$permisos = ['email'];
	$link = 'http://elvis.com:8085/projects/lovers/facebook-access-token?redirect=login';

	$url = $helper->getLoginUrl($link,$permisos);

	echo '<a class="facebook_login_btn" href=" '. $url .' ">Iniciar sesion con Facebook</a>';
?>