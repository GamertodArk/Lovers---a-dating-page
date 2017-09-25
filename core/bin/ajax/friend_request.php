<?php 
	$db = new Conexion();
	$user_s = $db->real_escape_string($objeto['user_s']);
	$user_r = $db->real_escape_string($objeto['user_r']);
	$sql = $db->query("SELECT aprobado FROM amigos_solicitud WHERE user_s = '$user_s' AND user_r = '$user_r' LIMIT 1;");
	
		if ($db->rows($sql) === 0) {

				$time = date('d/m/Y  h:s');
				$db->query("INSERT INTO amigos_solicitud (user_s,user_r,time) VALUES ('$user_s','$user_r','$time') ;");
				echo 'success';
		}else {
			$aprobado = $db->recorrer($sql)[0];
			if ($aprobado === 1) {
				echo 'friends';
			}else {
				echo 'sent';
			}
		}

	

	$db->liberar($sql);
	$db->close();
?>