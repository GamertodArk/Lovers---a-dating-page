<?php 
	/**
	* Esta clase me ayuda a conectarme a la base de datos y administrar sus resultados
	*/
	class Conexion extends mysqli
	{
		function __construct()
		{
			parent::__construct(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			$this->connect_errno ? die('error en la conexion') : null;
			$this->set_charset('tf8');
		}

		public function rows($query)
		{
			return mysqli_num_rows($query);
		}

		public function liberar($query)
		{
			return mysqli_free_result($query);
		}

		public function recorrer($query)
		{
			return mysqli_fetch_array($query);
		}
	}

?>