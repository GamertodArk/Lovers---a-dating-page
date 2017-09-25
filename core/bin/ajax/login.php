<?php 
	if (!empty($objeto['email']) && !empty($objeto['password'])) {
		
		$db = new Conexion();

		$email = $db->real_escape_string($objeto['email']);
		$password = sha1($objeto['password']);

		$sql = $db->query("SELECT id FROM usuarios WHERE email = '$email' AND password = '$password' LIMIT 1;");

		if ($db->rows($sql) > 0) {

			$_SESSION['user_id'] = $db->recorrer($sql)[0];
			echo 'success';

		}else {
			$json = [
				'class' => 'error',
				'mensaje' => 'Los datos ingresados no existen'
			];

			echo json_encode($json);

		}

		$db->liberar($sql);
		$db->close();

	}else {

		$json =[
		'class' => 'error' ,
		'mensaje' => 'Los datos ingresados no pueden estar vacios'
		];

		echo json_encode($json);

	}

?>