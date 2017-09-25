<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Busca pareja</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>search_friends_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<div class="wrap">
					<h2>Lovers</h2>
					<form action="search-friends" method="GET">
						<input type="text" name="search" id="search" placeholder="Buscar">
						<input type="submit" value="Buscar" onclick="	var input_empty_test = document.getElementById('search');if (input_empty_test.value == '') {return false;}">
					</form>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<?php include JS_SCRIPTS; ?>
</body>
</html>