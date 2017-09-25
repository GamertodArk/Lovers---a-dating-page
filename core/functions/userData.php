<?php 

	function userData()
	{
		$db = new Conexion();
		$sql = $db->query(" SELECT * FROM usuarios ;");

		if ($db->rows($sql) > 0) {
			
			while ($data = $db->recorrer($sql)) {
				$usuarios[$data['id']] = $data;
			}

		}else {
			$usuarios = false;
		}

		$db->liberar($sql);
		$db->close();
		return $usuarios;
	}
	
?>