<?php 
	if ( isset($_SESSION['facebook_access_token']) && isset($_SESSION['user_id']) ) {
		
		$fb = new \Facebook\Facebook([
			'app_id' 	 => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			'persistent_data_handler' => 'session'
		]);

		try {
			$imageRequest = $fb->get('/me/picture?redirect=false&width=300', $_SESSION['facebook_access_token']);
			$userRequest = $fb->get('/me?fields=id', $_SESSION['facebook_access_token']);
		} catch (Facebook\Exceptions\FacebookResponseException $e) {
			header('location: signup?error=1&message=Ocurrio-un-error:-' . $e->getMessage());
			exit();
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			header('location: signup?error=1&message=Ocurrio-un-error:-' . $e->getMessage());
			exit();		
		}

		// Traemos los datos desde facebook
		$user = $userRequest->getGraphUser();
		$image = $imageRequest->getGraphUser();

		// Lo preparamos todo para guardar la imagen y insertarla en la base de datos
		$picture_name = $user['id'] . '.jpg';
		$picture = 'views/app/img/users/profile_pictures/' . $picture_name;
		$profile_picture = file_get_contents($image['url']);

		// guardamos el id del usuario para poder userlo en la consulta SQL
		$id = $_SESSION['user_id'];

		// Guardamos la imagen
		file_put_contents($picture, $profile_picture);

		// La insertamos en la columna del usuarios
		$db = new Conexion();
		$db->query("UPDATE usuarios SET profile_img = '$picture_name' WHERE id = '$id' LIMIT 1 ;");
		$db->close();		

		// Redireccionamos el usuario al front
		header('location: front');

	}else {
		header('location: home');
	}


?>