
<body>

<h2>Nouveau POST</h2>

<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<?php  App\Core\Form::showForm($form); ?>
</body>