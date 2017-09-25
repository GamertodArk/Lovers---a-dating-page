<?php  

	// Iniciamos la conexion con la base de datos
	$db = new Conexion();

	// Escapamos los datos recividos desde el cliente
	$pais = $db->real_escape_string($objeto['pais']);
	$nombre = $db->real_escape_string($objeto['nombre']);
	$gender = $db->real_escape_string($objeto['gender']);
	$interes = $db->real_escape_string($objeto['interes']);
	$apellido = $db->real_escape_string($objeto['apellido']);
	$born_date = $db->real_escape_string($objeto['born_date']);
	$descripcion = $db->real_escape_string($objeto['descripcion']);

	// Id del usuarios
	$id = $_SESSION['user_id'];

	// Edad del usuario
	$edad = date('Y') - $objeto['user_born_year'];

	// Actualizamos la fila en la base de datos
	$db->query("UPDATE usuarios SET 
		edad = '$edad',
		pais = '$pais',
		genero = '$gender',
		nombre = '$nombre',
		interes = '$interes',
		apellido = '$apellido',
		descripcion = '$descripcion',
		nacimiento_fecha = '$born_date'

		WHERE id = '$id' LIMIT 1;");

	$db->close();

	echo 'success';
?>