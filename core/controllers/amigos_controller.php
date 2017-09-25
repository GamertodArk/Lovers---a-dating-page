<?php 
	if (isset($_SESSION['user_id'])) {
		
		$db = new Conexion();
		
		$user_id = $_SESSION['user_id'];

		// Solicitudes de amistad
		$sql = $db->query("SELECT user_s FROM amigos_solicitud WHERE user_r = '$user_id' AND aprobado = 0 ;");
		if ($db->rows($sql) > 0) {
			
			while ($solicitudes = $db->recorrer($sql) ) {
				$datos[] = $solicitudes;
			}

			$s_a = true;

		}else {
			$s_a = false;
		}
		$db->liberar($sql);
		unset($sql);


		// Amigos
		$sql = $db->query("SELECT user_s,user_r FROM amigos_solicitud WHERE user_r = '$user_id' AND aprobado = 1 OR user_s = '$user_id' AND aprobado = 1 ;");
		if ($db->rows($sql) > 0) {

			while ($amigos_aprobados = $db->recorrer($sql)) {
				$amigos[] = $amigos_aprobados;
			}

			$a_a = true;
		}else {
			$a_a = false;
		}


		$db->close(); 

		include TEMP_URL . 'amigos.php';

	}else {
		header('location: home');
	}
?>