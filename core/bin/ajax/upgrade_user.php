<?php  
	$db = new Conexion();
	$id = $db->real_escape_string($objeto['id']);
	$db->query("UPDATE usuarios SET permisos = 1 WHERE id = '$id' LIMIT 1;");
	$db->close();

	echo 'success';
?>