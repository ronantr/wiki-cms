<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="ceci est la page de template">
		<link rel=stylesheet href="<?php echo App\Core\View::lookupfile('main.css'); ?>" >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
		<link rel="icon" href=<?php echo App\Core\View::lookupfile('Logo.png'); ?> sizes="32x32">

	</head>
	<body>
		<header>
			<div class="container">
				<a href="#" id="logo-link">
					<img src=<?php echo App\Core\View::lookupfile('Logo.png'); ?> alt="logo">
				</a>
				<nav id="main-nav">
					<ul>
						<li><a href="#"> <?php isset($_SESSION["username"]) ? 'test' : 'invité';?> </a></li>
						<li><a href="/add-post">Create Post</a></li>
						<li><a>|</a></li>
						<li><a href="/logout">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
			<div class="nav_gauche">
				<div class="row">
					<a href="/tableau-de-bord">Dashboard Home</a>
					<a href="#">Media</a>
					<a href="#">Pages</a>
					<a href="/liste-post">Posts</a>
					<a href="#">Commentaires</a>
					<a href="#">Thèmes</a>
					<a href="/admin/liste-utilisateurs">Utilisateurs</a>
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