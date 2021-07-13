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
						<li><a href="post">Create Post</a></li>
						<li><a>|</a></li>
						<li><a href="#">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<main>
			<div class="nav_gauche">
				<div class="row">
					
				</div>
			</div>
			<!-- intégrer le vue -->
			<?php include $this->view ?>
		</main>
	</body>
</html>