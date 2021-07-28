<!DOCTYPE html>
<html lang="fr">


	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="ceci est la page de front">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?>>
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
	</head>

	<body>
		<header>
			<div class="container">
				<nav class="navbar">
					<?php if (!App\Core\Security::isConnected()) { ?> <a href="/login">Connexion</a>
						<a href="/s-inscrire">Incription</a>
					<?php } else { ?>
						<a href="#"> <?php echo $_SESSION['username'] ?> </a>
						<a href="/logout">Déconnexion</a><?php
														} ?>


				</nav>
			</div>

		</header>
		<div class="flex-col height-100">
			<?php include $this->view ?>
		</div>

		

	</body>


</html>