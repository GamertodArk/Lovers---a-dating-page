<?php
	// Este es un enrutador, me ayuda con los enlaces amigables y derigir al usuario al controller que quiero

	include 'core/core.php';

	$url_parts = parse_url($_SERVER['REQUEST_URI']);
	$url = $url_parts['path'];
	$part = explode('/', $url);


	if (empty($part[3])) {
		include 'core/controllers/home_controller.php';
	}elseif (file_exists('core/controllers/' . strtolower($part[3]) . '_controller.php')) {
		include 'core/controllers/' . strtolower($part[3]) . '_controller.php';
	}else {
		include 'core/errors/404/404.html';
	}
?>