<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="page d'installer">
		<link rel=stylesheet type="text/css" href=<?php echo App\Core\View::lookupfile('back.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
		<link rel="icon" href=<?php echo App\Core\View::lookupfile('Logo.png'); ?> sizes="32x32">

	</head>
    <body>
    <main>
		<h1 class="titleh1"> Installer</h1>
			<section class="main">
				<div class="containermain">
                    <?php include $this->view; ?>
				</div>
			</section>
		</main>
	</body>
</html>