<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="ceci est la page de front">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
	</head>
	<body>
		<header>
			<div class="container">
				<nav id="main-nav">
					<ul>
						<?php if ( !App\Core\Security::isConnected()) { ?> <li><a href="/login">Login</a></li>
						<li><a href="/s-inscrire">Register</a></li>	
							<?php }else{ ?> 
						<li><a href="admin/user?nom=<?php echo $_SESSION['username'] ?>"> <?php echo $_SESSION['username'] ?> </a></li>
						<li><a href="/logout">Déconnexion</a></li><?php
						} ?>
						
						
					</ul>
				</nav>
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