<?php 
	$db = new Conexion();
	$email = $db->real_escape_string($objeto['email']);
	$sql = $db->query("SELECT activado,nombre,apellido,email FROM usuarios WHERE email = '$email' LIMIT 1;");

	// Comprobamos que el email existe
	if ($db->rows($sql) > 0) {
			
		// Recojemos los datos desde la base de datos
		$user_data = $db->recorrer($sql);

		// Comprobamos que el usuario confirmo su email
		if ($user_data['activado'] === 'SI') {



			$key = md5(time());
			$link = 'http://elvis.com:8085/projects/lovers/confirm_password_key?key=' . $key;


			// Enviamos el email con PHPMailer
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
			$mail->addAddress($user_data['email'], $user_data['nombre'] . ' ' . $user_data['apellido']);
			$mail->isHTML(true);                                  

			$mail->Subject = 'Solicitud de cambio de contraseña';
			$mail->Body    = rec_pass_template($user_data['nombre'],$user_data['apellido'], $link);
			$mail->AltBody = rec_pass_template($user_data['nombre'],$user_data['apellido'], $link);

			if(!$mail->send()) {

			    $json = [
			    	"class"   => "error",
			    	"message" => "Ha ocurrido un error al intentar enviar el email, intenta de nuevo. Datos del error: " . $mail->ErrorInfo
			    ];

			    echo json_encode($json);
			} else {
				// Insertamos la llave en la base de datos y le avisamos al navegador que todo esta bien
			    $db->query("UPDATE usuarios SET password_rec_key = '$key' WHERE email = '$email' LIMIT 1 ;");
			    echo 'success';
			}

		}else {

			$json = [
				"class" => 'error',
				"message" => 'Esta direccion de correo electronico no esta confirmada, no puedes pedir una recuperacion de contraseña con un email no confirmado'
			];

			echo json_encode($json);			
		}

	}else {
		$json = [
			"class" => 'error',
			"message" => 'Tu correo electronico no existe'
		];

		echo json_encode($json);
	}

	$db->liberar($sql);
	$db->close();
?>