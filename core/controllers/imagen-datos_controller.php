<?php 
	if (isset($_SESSION['user_id']) && isset($_FILES)) {

		// Comprobamos que no ocurrieron errores en la subida del archivo
		if ($_FILES['file']['error'] < 1) {
			
			// Datos de la imagen
			$name = 'user_' . $_SESSION['user_id'];
			$type = $_FILES['file']['type'];
			$size = $_FILES['file']['size'];

			// Comprobamos que el archivo ingresado sea una imagen
			if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {

				// Selecionamos el formato de la imagen
				if ($type === 'image/jpg') {

					// JPG
					$formato = '.jpg';

				}elseif ($type === 'image/jpeg') {

					// JPEG
					$formato = '.jpeg';

				}elseif ($type === 'image/png') {

					// PNG
					$formato = '.png';

				}elseif ($type === 'image/gif') {

					// GIF
					$formato = '.gif';
				}


				// Comprobamos el tamaño de la imagen
				if ($size <= 8000000) {
					

					// Archivo en la ruta de destino
					$file = $_SERVER['DOCUMENT_ROOT'] . '/projects/lovers/views/app/img/users/profile_pictures/' . $name . $formato;

					// Movemos la imagen
					move_uploaded_file($_FILES['file']['tmp_name'], $file);

					
					//Id del usuario
					$id = $_SESSION['user_id']; 

					// Nombre final de la imagen
					$final_name = $name . $formato;

					// Actualizamos la foto de perfil en la base de datos
					$db = new Conexion();
					$db->query("UPDATE usuarios SET profile_img = '$final_name' WHERE id = '$id' LIMIT 1;");
					$db->close();

					// Redireccionamos al usuario a su perfil
					header('location: perfil?id=' . $_SESSION['user_id']);

				}else {
					header('location: selecionar-imagen?message=El-tamaño-de-la-imagen-es-demasiado-grande');
				}

			}else {
				header('location: selecionar-imagen?message=El-archivo-ingresado-no-es-una-imagen');
			}

		}else {
			header('location: selecionar-imagen?message=Ha-ocurrido-un-error-en-la-subida-de-la-imagen');
		}
	}else {
		header('location: home');
	}
?>