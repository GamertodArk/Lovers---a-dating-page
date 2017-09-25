<?php  
	if (isset($_SESSION['user_id'])) {

		// Comprobamos que el id del usuario esta definido y no es el de nosotros
		if (isset($_GET['id']) && $_GET['id'] != $_SESSION['user_id'] && array_key_exists($_GET['id'], $_usuarios)) {

			// Datos del usuario con el que esta hablando
			$id = $_GET['id'];
			$user_name = $_usuarios[$id]['nombre'] . ' ' . $user_name = $_usuarios[$id]['apellido'];
			$user_img = $_usuarios[$id]['profile_img'];

			// // Empezamos con los mensajes
			$db = new Conexion();
			$db_id = $db->real_escape_string($_GET['id']);
			$our_id = $_SESSION['user_id'];
			$sql = $db->query("SELECT user_r,user_s,mensaje FROM mensajes WHERE user_r = '$db_id' AND user_s = '$our_id' OR user_r = '$our_id' AND user_s = '$db_id' ORDER BY hora ASC ;");

				if ($db->rows($sql) > 0) {
					
					while ($mensaje = $db->recorrer($sql)) {
						$mensajes[] = $mensaje;
					}

				}else {
					$mensajes = false;
				}

			$db->liberar($sql);
			$db->close();

			include TEMP_URL . 'mensajes.php';	
			
		}else {

			// Lista de usuarios con los ha enviamdo o recibido mensajes
			$db = new Conexion();
			$our_id = $_SESSION['user_id'];
			$sql = $db->query("SELECT user_s FROM mensajes WHERE user_r = '$our_id';");
				if ($db->rows($sql) > 0) {
	
					while ($user = $db->recorrer($sql)) {
						$users[] = $user; 
					}
				}else {
					$users = false;
				}
				// Template para mostrar la lista
				include TEMP_URL . 'usuarios_mensajes_lista.php';

			$db->liberar($sql);
			$db->close();
		}
	}else {
		header('location: home');
	} 
?>