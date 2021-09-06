<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title ?></title>
		<script src="https://cdn.tiny.cloud/1/eo59fq7w6j1puvdqjeu1rpwttfb7zmw1xt5pz6cxsykca6l9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		


		<script>
			tinymce.init({
			selector: 'textarea',
			height: 500,
		    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
			menubar: 'file edit view insert format tools table help',
		    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
			toolbar_mode: 'floating',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Author name',
		});
		</script>
		<meta name="description" content="Back">
		<link rel=stylesheet type="text/css"  type="text/css" href=<?php echo App\Core\View::lookupfile('back.css'); ?> >
		<script type="text/javascript" src=<?php echo App\Core\View::lookupfile('main.js'); ?>></script>
		<link rel="icon" href=<?php echo App\Core\View::lookupfile('icon.png'); ?> sizes="32x32">

	</head>
	<body>
		<header>
			<div class="container">
				<a href="/" id="logo-link">
					<img src=<?php echo App\Core\View::lookupfile('Logo.png'); ?> alt="logo">
				</a>
				<nav id="main-nav">
					<ul>
						<li><a href="/admin/user?nom=<?php echo $_SESSION['username'] ?>"> <?php echo strtoupper($_SESSION['username']); ?> </a></li>
						<li><a href="/admin/add-page">Create Page</a></li>
						<li><a href="/admin/add-post">Create Post</a></li>
						<li><a href="/">Mon Site</a></li>
						<li><a>|</a></li>
						<li><a href="/logout">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
			<div class="nav_gauche">
				<div class="row">
					<a href="/admin/tableau-de-bord">Dashboard </a>
					<?php if($_SESSION['role'] == 1){  ?> <a href="/admin/menu">Gestion de menu</a><?php } ?>
					<a href="/admin/liste-Pages">Pages</a>
					<a href="/admin/liste-categorie">Catégories</a>
					<a href="/admin/liste-post">Posts</a>
					<a href="/admin/liste-commentaire">Commentaires</a>
					<?php if($_SESSION['role'] == 1){  ?> <a href="/admin/theme">Thèmes</a><?php } ?>
					<?php if($_SESSION['role'] == 1){  ?> <a href="/admin/users/liste-utilisateurs">Utilisateurs</a> <?php } ?>
						
				</div>
			</div>
		</header>
		<main>
			<section class="main">
				<div class="containermain">
					<div class="intercontainer">
						<?php if(isset($erreur)){ ?>
							<h1 class = "erreur"><?php echo $erreur ?></h1>

						<?php }?>
						<?php include $this->view; ?>
						<div class="separateur"></div>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>