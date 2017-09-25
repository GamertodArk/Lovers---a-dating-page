<?php  
	if (isset($_SESSION['facebook_access_token'])) {
		
		// Iniciamos el sdk de facebook para obtener el email
		$fb = new \Facebook\Facebook([
			'app_id' 	 => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			'persistent_data_handler' => 'session'
			]);

		// Hacemos el request
		try {
			$request = $fb->get('/me?fields=id,name,email',$_SESSION['facebook_access_token']);
		} catch (\Facebook\Exceptions\FacebookResponseException $e) {
			header('location: login?error=1&message=Ocurrio-un-error.-Informacion:-Graph-error:-' . $e->getMessage());
			exit();
		} catch (\Facebook\Exceptions\FacebookSDKException $e) {
			header('location: login?error=1&message=Ocurrio-un-error.-Informacion:-SDK-error:-' . $e->getMessage());
			exit();
		}

		// obtenemos los datos devueltos
		$user = $request->getGraphUser();

		// inicamos la conexion a la base de datos
		$db = new Conexion();
		$email = $db->real_escape_string($user['email']);
		$sql = $db->query("SELECT id FROM usuarios WHERE email = '$email' LIMIT 1;");

		// Comprobamos que el usuarios existe
		if ($db->rows($sql) > 0) {
			$_SESSION['user_id'] = $db->recorrer($sql)[0];
			header('location: front');
		}else {
			header('location: login?error=1&message=El-usuario-con-el-que-intentas-acceder-no-existe');
		}

		$db->liberar($sql);
		$db->close();
		

	}else {
		header('location: login');
	}
	
?>