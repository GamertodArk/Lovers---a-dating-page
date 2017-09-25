<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Reportar usuario</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>report_user_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS; ?>
			</header>
			<main id="main">
				<section class="wrap">
					<div class="user">
						<h2>Reportar a: <?php echo $name ?></h2>
						<img src="<?php echo $img; ?>" alt="<?php echo $name ?>" title="<?php echo $name ?>">
					</div>
					<div id="accion" class="accion">
						<form onkeypress="return send_key(event,<?php echo $id ?>)" id="report_form" action="">
							<label id="message_label" for="message">Razon de reporte:</label>
							<textarea name="message" id="message" form="report_form"></textarea>
							<button onclick="send(<?php echo $id; ?>); return false;">
								<p class="" id="button_text">Reportar</p>
								<span class="hidden" id="span_ico"><i class="icon  girar fa fa-refresh" aria-hidden="true"></i></span>
							</button>
						</form>
					</div>
					<div id="success" class="hidden success">
						<p>Usuario reportado correctamente</p>
					</div>
				</section>
			</main>
			<footer>
				<?php include FOOTER_TAGS; ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>send_report.js"></script>
	<?php include JS_SCRIPTS; ?>
</body>
</html>