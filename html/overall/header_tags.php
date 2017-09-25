<nav>
	<div class="name">
		<span></span>
		<a href="home" class="logo">Lovers</a>
		<a href="#" id="menu_btn"><i id="icon" class="fa fa-bars" aria-hidden="true"></i></a>
	</div>
	<div class="links">
		<?php 
			if (isset($_SESSION['user_id'])) {
				echo '
					<a href="front">Home</a>
					<a href="perfil?id='. $_SESSION['user_id'] .'">' . $_usuarios[$_SESSION['user_id']]['nombre'] .'</a>
					<a href="amigos">Amigos</a>
					<a href="logout">Cerrar sesion</a>';
			}else {
				echo '	
					<a href="home">Inicio</a>
					<a href="quienes-somos">¿Quienes somos?</a>
					<a href="login">Iniciar sesion</a>
					<a href="signup">Registrarse</a>';
			}
		 ?>
 	</div>
</nav>