<?php  
	$db = new Conexion();
	$user_s = $db->real_escape_string($objeto['user_s']);
	$user_r = $db->real_escape_string($objeto['user_r']);
	$time_aprobado = date('d/m/Y  H:s');
	$db->query("UPDATE amigos_solicitud SET aprobado = 1, time_aprobado = '$time_aprobado' WHERE user_s = '$user_s' AND user_r = '$user_r' LIMIT 1;");
	echo 'success';
	$db->close();
?>