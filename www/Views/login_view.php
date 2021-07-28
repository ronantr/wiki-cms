


<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<div class="login">
	<h1>Connexion</h1>
	<?php  App\Core\Form::showForm($form); ?>
</div>

