<?php  
	// Eliminamos el usuario
	$db = new Conexion();
	$id = $db->real_escape_string($objeto['user_id']);

	// Eliminamos el usuario de la base de datos
	$db->query("DELETE FROM usuarios WHERE id = '$id' LIMIT 1;");

	// Eliminamos las solicitudes de amistad relacionadas con ese usuario
	$db->query("DELETE FROM amigos_solicitud WHERE user_s = '$id' OR user_r = '$id';");

	// Eliminamos los mensaje relacionados con ese usuario
	$db->query("DELETE FROM mensajes WHERE user_r = '$id' OR user_s = '$id' ;");

	$db->close();

	// Mostramos el mensaje de exito
	echo 'success';
?>