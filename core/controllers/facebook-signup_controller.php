<?php  
	$fb = new \Facebook\Facebook([
		'app_id' 	 => FB_APP_ID,
		'app_secret' => FB_APP_SECRET,
		'default_graph_version' => 'v2.10',
		'persistent_data_handler' => 'session'
	]);

	try {
		$response = $fb->get('/me?fields=id,email,first_name,last_name,gender,interested_in,location,birthday',$_SESSION['facebook_access_token']);
	} catch (Facebook\Exceptions\FacebookResponseException $e) {
		// Error enviado al signup
		header('location: signup?error=1&message=Ocurrio-un-error:-' . $e->getMessage()); 
		exit();
	} catch (Facebook\Exceptions\FacebookSDKException $e) {
		// Error enviado al signup
		header('location: signup?error=1&message=Ocurrio-un-error:-' . $e->getMessage()); 
		exit();		
	}

	$user = $response->getGraphUser()->asArray();

	$facebook_id = $user['id'];
	$name = $user['first_name'];
	$last_name = $user['last_name'];
	$email = $user['email'];

	// tratamos de obtener la fecha de nacimiento y la edad del usuario
	$birthday = $user['birthday'];

	if ($birthday->hasYear()) {
		if ($birthday->hasDate()) {

			$birthday_date = $birthday->format('d/m/Y');
			$edad = date('Y') - $birthday->format('Y');
		}else {

			$birthday_date = $birthday->format('Y');
			$edad = date('Y') - $birthday->format('Y');

		}
	}else {
		$birthday_date = $birthday->format('d/m');
		$edad = 16;
	}

	// Interes del usuario
	if ($user['interested_in'][0] == 'female') {
		$interes = 'Mujeres';
	}else if ($user['interested_in'][0] == 'male') {
		$interes = 'Hombres';
	}else {
		$interes = 'Ambos';
	}

	// Genero del usuario
	if ($user['gender'] == 'male') {
		$genero = 'Hombre';
	}else {
		$genero = 'Mujer';
	}

	// Pais del usuario
 	$pais = explode(',', $user['location']['name']);
 	$user_country = str_replace(' ', '', $pais[1]);

 	// Contraseña prederteminada
 	$password = sha1(12345);

 	// Iniciamos la conexion a la base de datos
 	$db = new Conexion();
 	$sql = $db->query("SELECT id FROM usuarios WHERE email  = '$email' LIMIT 1;");
 	if ($db->rows($sql) == 0) {

 		// Enviamos el Eamil
 		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "quoted-printable";
		$mail->Helo = 'elvis.com';
		$mail->isSMTP();                                      
		$mail->Host = PHPMailer_HOST;  
		$mail->SMTPAuth = true;                               
		$mail->Username = PHPMailer_USER;                 
		$mail->Password = PHPMailer_PASS;                           
		$mail->SMTPSecure = 'ssl';                            
		$mail->Port = PHPMailer_PORT;                                    
		$mail->setFrom('lovers@noreply.com', 'Lovers');
		$mail->addAddress($email, $name . ' ' . $last_name);
		$mail->isHTML(true);                                  

		$mail->Subject = 'Gracias por registrarte en Lovers!';
		$mail->Body    = facebook_rec_template($name,$last_name);
		$mail->AltBody = facebook_rec_template($name,$last_name); 

		if( !$mail->send() ) {

			// SI no se envio le decimas al usuario
			header('location: signup?error=1&message=Ocurrio-un-error:-' . $mail->ErrorInfo); 
			exit();		   
		} else {

			// Insertamos la datos del usuarios en la base de datos
	 		$db->query("INSERT INTO usuarios (nombre,apellido,edad,nacimiento_fecha,genero,interes,pais,email,password,facebook_reg,facebook_id,activado) VALUES 
	 		('$name','$last_name','$edad','$birthday_date','$genero','$interes','$user_country','$email','$password','SI','$facebook_id','SI') ;");

	 		// Sacamos sus datos para usarlos en la web
	 		$sql_2 = $db->query("SELECT MAX(id) AS id FROM usuarios;");
	 		$_SESSION['user_id'] = $db->recorrer($sql_2)[0];
	 		$db->liberar($sql_2);

	 		// Redireccionamos al usuarios para obtener su imagen de perfil
	 		header('location: facebook_image');
		}

 	}else {
 		// Si el email esta en uso se lo decimos al usuario
 		header('location: signup?error=1&message=El-correo-electronico-ya-esta-en-uso'); 
		exit();	 		
 	}
 	$db->liberar($sql);
 	$db->close();
?>