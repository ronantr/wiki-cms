<!DOCTYPE html>
<html lang="fr">

<<<<<<< HEAD
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<meta name="description" content="ceci est la page de template">
	<link rel=stylesheet href="<?php echo App\Core\View::lookupfile('main.css'); ?>">
	<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
	<link rel="icon" href=<?php echo App\Core\View::lookupfile('Logo.png'); ?> sizes="32x32">

</head>

<body>
	<nav class="navbar">
		<a href="/admin/tableau-de-bord">Dashboard Home</a>
		<a href="#">Media</a>
		<a href="/admin/liste-Pages">Pages</a>
		<a href="/admin/liste-post">Posts</a>
		<a href="/admin/liste-commentaire">Commentaires</a>
		<a href="#">Thèmes</a>
		<a>|</a>
		<a href="/admin/add-page">Créer une page</a>
		<a href="/admin/add-post">Créer un post</a>
		<a>|</a>
		<a href="/logout">Déconnexion</a>
	</nav>
	<div class="nav_gauche">
		<div class="row">
			<?php if ($_SESSION['role'] == 1) {  ?> <a href="/admin/users/liste-utilisateurs">Utilisateurs</a> <?php } ?>

			<a href="#">Paramètres</a>
		</div>
	</div>
	<main>
		<section class="main">
			<div class="containermain">
				<?php include $this->view; ?>
			</div>
		</section>
	</main>
</body>

</html>