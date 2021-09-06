
<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo"<h1>Mail exist</h1>";
        break;
    case 2:
        echo"<h1></h1>";
        break;
}}?>
<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<div class="login">
	<h1>Inscription</h1>

	<?php  App\Core\Form::showForm($form); ?>
</div>