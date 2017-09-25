<?php
	session_start();
	date_default_timezone_set('America/Caracas');

	#constantes de direcciones
	define('TEMP_URL', 'html/templates/');
	define('SERVER', 'http://elvis.com:8085/projects/lovers/');
	define('JS_URL', SERVER . 'core/bin/js/');
	define('CSS_URL', SERVER . 'core/bin/css/');
	define('IMG_URL', SERVER . 'views/app/img/users/profile_pictures/');

	#Etiquetas constantes
	define('HEAD_TAGS', 'html/overall/head_tags.php');
	define('HEADER_TAGS', 'html/overall/header_tags.php');
	define('FOOTER_TAGS', 'html/overall/footer_tags.php');
	define('JS_SCRIPTS', 'html/overall/js_scripts.php');
	define('FB_JS_SDK', 'html/overall/fb_js_sdk.php');
	
	#Constantes de la base de datos
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_HOST', 'elvis.com');
	define('DB_NAME', 'Lovers');

	#Constantes de PHPMailer
	define('PHPMailer_HOST', 'p3plcpnl0173.prod.phx3.secureserver.net');
	define('PHPMailer_USER', 'public@ocrend.com');
	define('PHPMailer_PASS', 'Prinick2016');
	define('PHPMailer_PORT', 465);

	// Constantes de facebook
	define('FB_APP_ID', '1963581463879349');
	define('FB_APP_SECRET', '4e726716d374cf0364c14dad04a5c24a');

	// estructura
	include 'vendor/autoload.php';
 	include 'core/functions/replace.php';
 	include 'core/functions/userData.php';
	include 'core/models/class.Conexion.php';
 	include 'core/functions/pass_rec_template.php';
 	include 'core/functions/facebook_rec_email_template.php';
 	include 'core/functions/regist_confirmation_template.php';




 	// Variables globales
	$_usuarios = userData();

?>