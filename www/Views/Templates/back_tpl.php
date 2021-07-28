<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="ceci est la page de template">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?> >
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
						<li><a href="/admin/add-page">Create Page</a></li>
						<li><a href="/admin/add-post">Create Post</a></li>
						<li><a>|</a></li>
						<li><a href="/logout">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
			<div class="nav_gauche">
				<div class="row">
					<a href="/admin/tableau-de-bord">Dashboard Home</a>
					<a href="#">Media</a>
					<a href="/admin/liste-Pages">Pages</a>
					<a href="/admin/liste-categorie">Catégories</a>
					<a href="/admin/liste-post">Posts</a>
					<a href="/admin/liste-commentaire">Commentaires</a>
					<a href="#">Thèmes</a>
					<?php if($_SESSION['role'] == 1){  ?> <a href="/admin/users/liste-utilisateurs">Utilisateurs</a> <?php } ?>
						
				</div>
			</div>
		</header>
		<main>
			<section class="main">
				<div class="containermain">
					<?php include $this->view; ?>
				</div>
			</section>
		</main>
	</body>
</html>