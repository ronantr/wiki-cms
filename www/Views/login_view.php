<?php if (!empty($formErrors)) : ?>
	<?php foreach ($formErrors as $error) : ?>
		<li><?= $error; ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<div class="login flex-col">
		<h1>Connexion</h1>
		<?php App\Core\Form::showForm($form); ?>
		<div class="link-container">
			<a class="link" href="/recuperationmdp">Mot de passe oublié ?</a><span>&nbsp;&nbsp;·&nbsp;&nbsp;</span><a class="link" href="/s-inscrire">S'inscrire</a>
		</div>
	</div>