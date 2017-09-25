<?php 
	if ($_POST) {

		// Recibo el objeto json desde el navegadorn del usuarios	
		$Objeto = json_decode($_POST['objeto'],true);

		// Inicio la conexion
		$db = new Conexion();

		// Escapo todos los capos posibles para evitar la inyeccion SQL
		$name = $db->real_escape_string($Objeto['name']);
		$pais = $db->real_escape_string($Objeto['pais']);
		$email = $db->real_escape_string($Objeto['email']);
		$genero = $db->real_escape_string($Objeto['genero']);
		$interes = $db->real_escape_string($Objeto['interes']);
		$lastName = $db->real_escape_string($Objeto['lastName']);
		$password = sha1($Objeto['password']);

		// Construyo la edad del usuario
		$birthday = $Objeto['birthday_date']['day'] . '/' . $Objeto['birthday_date']['month'] . '/' . $Objeto['birthday_date']['year'];

		// Calcúlo la edad del usuario
		$edad = date('Y') - $Objeto['birthday_date']['year'];


		try {

			// Compruebo que el email que el usuario ingreso no este en uso
			$sql = $db->query("SELECT id FROM usuarios WHERE email = '$email' LIMIT 1 ;");
			if ($db->rows($sql) > 0) {
				throw new Exception('El correo electronico ya esta en uso',1);
			}
			$db->liberar($sql);
		} catch (Exception $e) {

			// Si el email esta en uso envio un objeto json al navegador diciendo Los datos que necesita
			$json = [
				"class"   	  => "error",
				"mensaje" 	  => $e->getMessage()
			]; 
			echo json_encode($json);
			exit();
		}

			$key = md5(time());
			$link ='http://elvis.com:8085/projects/lovers/confirmar?key=' . $key;
			// $link = 'Nojoda';


			// Mensaje enviado al usuario recien registrado
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
			$mail->addAddress($email, $name . ' ' . $lastName);     
			
			$mail->isHTML(true);                                  

			$mail->Subject = 'Gracias por registrarre en Lovers!';
			$mail->Body    = email_template($name,$lastName,$link);
			$mail->AltBody = 'Gracias por registrarte en Lovers!, ahora solo tienes que confirmar tu cuenta, lo unico que tienes que hacer es copiar el enlace y pegarlo en una nueva pestalla de tu navegar, el enlace es:' . $link;

			if(!$mail->send()) {

				// Si el mensaje no se envia
			    $json = [
			    	"class" => "error",
			    	"mensaje" => 'Ha ocurrido un error, por favor vuelva a intentarlo...' . $mail->ErrorInfo 
			    ];

			    echo json_encode($json);

			} else {

				// Si el mensaje se envia
				$db->query("INSERT INTO usuarios (nombre,apellido,edad,nacimiento_fecha,genero,interes,pais,email,password,facebook_reg,facebook_id,keyReg,activado) 
				VALUES ('$name','$lastName','$edad','$birthday','$genero','$interes','$pais','$email','$password','NO','0000','$key','no');");

				$sql_2 = $db->query("SELECT MAX(id) AS id FROM usuarios ;");
				$_SESSION['user_id'] = $db->recorrer($sql_2)[0];

				$db->liberar($sql_2);
				$db->close();

				// Damos la señal para indicar de que todo esta bien
				echo 'success';
			}



		
	}else {
		header('location: home');
	}
?>