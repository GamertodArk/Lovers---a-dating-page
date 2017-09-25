<?php 
	
	$fb = new Facebook\Facebook([
			'app_id' 	 => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			'persistent_data_handler' => 'session'
		]);

	$helper = $fb->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch (Facebook\Exceptions\FacebookResponseExceptio $e) {
		// Error del api graph
		header('location: ' . $_GET['redirect'] . '?error=1&message=Ocurrio-un-error:-' . $e->getMessage() . '-.-Codigo del error:-' . $e->getCode());
		exit();
	} catch (Facebook\Exceptions\FacebookSDKException $e) {
		// Error del SDK
		header('location: ' . $_GET['redirect'] . '?error=1&message=Ocurrio-un-error:-' . $e->getMessage() . '-.-Codigo del error:-' . $e->getCode());
		exit();
	}

	if (! isset($accessToken)) {
		if ($helper->getError()) {
			// El usuario no autorizo nuesta app
			header('location: ' . $_GET['redirect'] . '?error=1&message=Tienes-que-autorizar-esta-web-para-iniciar-sesion-con-facebook'); 
		}else {
			// Este error sucede cuando el usuario entra en esta pagina sin haber clikeado el link del loign con facebook
			header('location: login');
		}
		exit();
	}

	// Autenticamos el accessToken con OAuth2Client
	$oAuth2Client = $fb->getOAuth2Client();
	$medata = $oAuth2Client->debugToken($accessToken);

	$medata->validateAppId(FB_APP_ID);
	$medata->validateExpiration();

	if (! $accessToken->isLongLived()) {
		try {
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			header('location: ' . $_GET['redirect'] . '?error=1&message=Ocurrio-un-error:-' . $e->getMessage() . '-.-Codigo del error:-' . $e->getCode());
			exit();
		}
	}

	$_SESSION['facebook_access_token'] = (string) $accessToken;
?>