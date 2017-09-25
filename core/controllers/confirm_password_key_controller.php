<?php  
	if (isset($_GET['key'])) {
		
		$db = new Conexion();
		$key = $db->real_escape_string($_GET['key']);
		$sql = $db->query("SELECT id FROM usuarios WHERE password_rec_key = '$key' LIMIT 1;");
			if ($db->rows($sql) > 0) {
				
				$_SESSION['user_id_temporal'] = $db->recorrer($sql)[0];	
				include TEMP_URL . 'set_new_password.php';

			}else {
				include TEMP_URL . 'confirm_password_key_error.php';
			}
		$db->liberar($sql);
		$db->close();

	}else {
		header('location: home');
	}
?>