<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Template de Back</title>
		<meta name="description" content="ceci est la page de template">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>

	</head>
	<body>
		<header>
			<div class="container">
				<a href="#" id="logo-link">
					<img src=<?php echo App\Core\View::lookupfile('Logo.png'); ?> alt="logo">
				</a>
				<nav id="main-nav">
					<ul>
						<li><a href="#">Pseudo</a></li>
						<li><a href="/post">Create Post</a></li>
						<li><a>|</a></li>
						<li><a href="#">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
			<div class="nav_gauche">
				<div class="row">
					<a href="/tableau-de-bord">Dashboard Home</a>
					<a href="#">Media</a>
					<a href="#">Pages</a>
					<a href="#">Articles</a>
					<a href="#">Commentaires</a>
					<a href="#">Thèmes</a>
					<a href="#">Utilisateurs</a>
					<a href="#">Paramètres</a>
				</div>
			</div>
		</header>
		<main>
			<section class="main">
				<div class="containermain">
					<?php include $this->view ?>
				</div>
			</section>
		</main>
	</body>
</html>