<?php 
	$fb = new Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			'persitent_data_handler' => 'session'
		]);

	$helper = $fb->getRedirectLoginHelper();

	$permisos = ['email','user_birthday','user_location','user_relationship_details'];
	$link = 'http://elvis.com:8085/projects/lovers/facebook-access-token?redirect=signup';

	$url = $helper->getLoginUrl($link,$permisos);

	echo '<a class="facebook_signup_url" href="' . $url . '">Continuar con facebook</a>';
?>