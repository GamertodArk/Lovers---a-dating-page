<?php 
	if (isset($_SESSION['user_id'])) {
		
		if ($_GET) {
			
			// Iniciamos el proceso de busqueda
			$db = new Conexion();
			$search = $db->real_escape_string($_GET['search']);
			$sql = $db->query("SELECT id FROM usuarios WHERE nombre LIKE '%$search%' OR apellido LIKE '%$search%' ;");
				if ($db->rows($sql) > 0) {
					
					// Metemos los datos devueltos desde la base de datos en un array
					while ($resultado = $db->recorrer($sql)) {
						$resultados[] = $resultado;
					}
							
					// incluimos el template para mostrar los resultados devueltos
					include TEMP_URL . 'user_found.php';

				}else{
					include TEMP_URL . 'no_result_friend.php';
				} 

			$db->liberar($sql);
			$db->close();


		}else {
			include TEMP_URL . 'search-friends-template.php';
		}

	}else {
		header('location: home');
	}

	//Esta parte tiene un bug, y es que cuando buscas a una persona tienes que hacerlo solo por su nombre, porque si ingresas su nombre mas su apellido, no te saldra nungun resultado, creo que esto es debido a que la sentencia query que hace la busqueda apunta solo a la columna nombre, por lo que si ingresas su nombre + su apellido no te saldra ningun resultado porque la sentencia query solo esta buscando el nombre 
?>