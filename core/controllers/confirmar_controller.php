<?php 
	
	if (isset($_GET['key'])) {
		if (isset($_SESSION['user_id'])) {
			
			$db = new Conexion();
			$id = $_SESSION['user_id'];
			$key = $db->real_escape_string($_GET['key']);
			$sql = $db->query("SELECT id FROM usuarios WHERE id='$id' AND keyReg='$key' LIMIT 1;");

			if ($db->rows($sql) > 0) {
				
				$db->query(" UPDATE usuarios SET activado = 'SI', keyReg = '' WHERE id = '$id' LIMIT 1 ;");

				// Redireccionar a otra pagina y Decirle al usuario que todo esta listo
				header('location: front?class=success&content=Feliciades!,-tu-cuenta-esta-activada-correctamente');

			}else {

				// Redireccionar a otra pagina y decirle al usuario que ocurrio un error
				header('location: front?class=error&content=Ha-ocurrido-un-error,-pruebe-de-nuevo');

			}
			$db->liberar($sql);
			$db->close();

		}else {
			header('location: login?needed=true');
		}
	}else {
		header('location: home');
	}

 ?>