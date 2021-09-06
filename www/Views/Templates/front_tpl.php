<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="page de front">
		<link rel=stylesheet href=<?php echo App\Core\View::lookupfile('main.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
	</head>
	<body>
		<header style="position:relative;">
			<div class="containernav">
				<nav id="main-nav">
					<ul>
						<li><a href="/">Accueil</a></li>
						<?php foreach($menu as $li){ ?>
						<li><a href="/<?php echo $li['url']; ?>"><?php echo ucfirst($li['slug']); ?></a></li> <?php } ?>
						<li><a href="#">|</a></li>
						<?php if ( !App\Core\Security::isConnected()) { ?> <li><a href="/login">Login</a></li>
						<li><a href="/s-inscrire">Register</a></li>	
							<?php }else{ ?> 
							<li><a <?php if($_SESSION['role'] == 1){ ?>
								  href="admin/user?nom=<?php echo $_SESSION['username']; ?>" <?php } 
								  else{ ?> href="moncompte" <?php } ?> > <?php echo $_SESSION['username'] ?> </a></li>
						<li><a href="/logout">Déconnexion</a></li><?php
						} ?>
						<?php if($_SESSION['role'] == 1){ 
							?><li><a href="/admin/tableau-de-bord">Admin</a></li><?php
						}?>
						
						
					</ul>
				</nav>
			</div>
		</header>	
		<main class="container">
			<div class = "containermargin">
	
			
				<?php include $this->view ?>
			</div>

		</main>
		<?php include 'footer_tpl.php'; ?>
	</body>
</html>