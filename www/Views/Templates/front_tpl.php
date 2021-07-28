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
			<div class="nav_gauche_front" style="width:20%;padding-top: 50px;">
				
				<div class="row">
					<div class="nav_height_front">
						<h1 style="vertical-align:center;">Pages</h1>
						 <?php $pages = new App\Models\Page;
						 		$allpage= $pages->getallpage();
						 	foreach($allpage as $page){
								 ?> <h4><a href="/<?php echo htmlspecialchars_decode($page['url']); ?>"><?php echo htmlspecialchars_decode($page['slug']); ?></a></h4>
							 <?php }
						 ?>
						<h1 style="vertical-align:center;">Catégories</h1>
							<?php $cat = new App\Models\Categorie;
									$categories= $cat->getCategories();
								foreach($categories as $categorie){
									?> <h4><a href="/categorie?id=<?php echo ($categorie['id']); ?>"><?php echo htmlspecialchars_decode($categorie['name']); ?></a></h4>
								<?php }
							?>
						<h1 style="vertical-align:center;">Tous les Article</h1>
						<?php $article = new App\Models\Post;
									$posts= $article->getPosts();
								foreach($posts as $post){
									?> <h4><a href="/post?id=<?php echo ($post['id']); ?>"><?php echo htmlspecialchars_decode($post['title']); ?></a></h4>
								<?php }
							?>
					</div>
					
				</div>
			</div>
		
		
			<section class="main">
				<div class="containermain">
					<?php include $this->view ?>
				</div>
			</section>
		</main>
	</body>
</html>