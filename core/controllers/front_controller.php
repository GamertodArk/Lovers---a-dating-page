<?php 
	if (isset($_SESSION['user_id']) && array_key_exists($_SESSION['user_id'], $_usuarios)) {

		/* SACAMOS LOS AMIGOS MAS RECIENTES DEL USUARIO	*/

		// Iniciamos la conexion a la base de datos para realizar la consulta sql
		$db = new Conexion(); 

		// Colocamos nuestro id en una variable para poder usarla en la sentencia sql
		$id = $_SESSION['user_id'];

		// Realizamos la sentencia sql para poder sacar los amigos recientes del usaurio
		$sql = $db->query("SELECT user_s FROM amigos_solicitud WHERE user_r = '$id' AND aprobado = 1 ORDER BY time_aprobado DESC LIMIT 3;");

		// Comprobamos que el usuario tenga por lo menos 1 amigo
		if ($db->rows($sql) > 0) {
			
			// Metemos los datos devueltos par la sentencia en un array
			while ($amigo = $db->recorrer($sql)) {
				$amigos[] = $amigo;
			}

		}else {
			$amigos = false;
		}


		// Liberamos el espacio ocupado por sentencia sql y cerramos la conexion
		$db->liberar($sql);
		$db->close();

		// Incluimos el template de front
		include TEMP_URL . 'front.php';
	}else {
		header('location: logout');
	}
?>