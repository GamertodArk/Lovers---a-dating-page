<?php 
	
	function replace($busca,$remplaza,$string)
	{
		$resultado = str_replace($busca, $remplaza, $string);
		return $resultado;
	}

?>