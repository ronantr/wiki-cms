<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Installeur</title>
		<meta name="description" content="ceci est la page de template">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
		<link rel="icon" href=<?php echo App\Core\View::lookupfile('Logo.png'); ?> sizes="32x32">

	</head>
    <body>
    <main>
			<section class="main">
				<div class="containermain">
                    <?php include $this->view; ?>
				</div>
			</section>
		</main>
	</body>
</html>