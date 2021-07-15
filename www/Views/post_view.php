<div>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>Titre</td>
                <td>content</td>
            </tr>
        </thead>
        <tbody>
            <?php
              
                foreach($allPosts as $post){
                if($post["id"]==$_GET["id"]){
                ?>
                <tr>
                    <td><?php echo $post["id"]?></td>
                    <td><?php echo($post["title"]);?></td>
                    <td><?php echo($post["content"]);?></td>
                </tr>
        </tbody>
        <?php }} ?>
</div>



<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<div class="commentaires">
	<h1>ajouté un commentaire</h1>
	<?php  App\Core\Form::showForm($form); ?>
</div>



<div>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>id_article</td>
                <td>id_user</td>
                <td>content</td>
            </tr>
        </thead>
        <tbody>
            <?php
              
                foreach($allCommentaire as $Commentairet){
                if($post["id"]==$_GET["id_article"]){
                ?>
                <tr>
                    <td><?php echo $post["id"]?></td>
                    <td><?php echo($post["id_article"]);?></td>
                    <td><?php echo($post["id_user"]);?></td>
                    <td><?php echo($post["content"]);?></td>
                </tr>
        </tbody>
        <?php }} ?>
</div>