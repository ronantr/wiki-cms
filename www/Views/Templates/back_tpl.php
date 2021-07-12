<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Template de Back</title>
		<meta name="description" content="ceci est la page de template">
	</head>
	<body>
		<header>
<<<<<<< HEAD
			<div class="container">
				<a href="#" id="logo-link">
					<img src=<?php echo App\Core\View::lookupfile('Logo.png'); ?> alt="logo">
				</a>
				<nav id="main-nav">
					<ul>
						<li><a href="#">Pseudo</a></li>
						<li><a href="#">Create Post</a></li>
						<li><a>|</a></li>
						<li><a href="#">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
=======
			<h1>Template Backoffice</h1>
>>>>>>> d0c53c45ef04b30c2d587517224686746be626e2
		</header>


		<!-- intégrer le vue -->
		<?php include $this->view ?>

	</body>
</html>