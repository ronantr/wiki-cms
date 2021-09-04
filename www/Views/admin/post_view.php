<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.tiny.cloud/1/eo59fq7w6j1puvdqjeu1rpwttfb7zmw1xt5pz6cxsykca6l9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



  <script>
    tinymce.init({
      selector: 'textarea',
      width: 800,
      height: 500,
      menubar: '  ',
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>
</head>


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
                    <td><?php echo(htmlspecialchars_decode($post["content"]));?></td>
                </tr>
        </tbody>
        <?php }} ?>
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
              
                foreach($allCommentaire as $Commentaire){
                if($Commentaire["id_article"]==$_GET["id"]){
                ?>
                <tr>
                    <td><?php echo $Commentaire["id"]?></td>
                    <td><?php echo($Commentaire["id_article"]);?></td>
                    <td><?php echo($Commentaire["id_user"]);?></td>
                    <td><?php echo(htmlspecialchars_decode($Commentaire["content"]));?></td>
                </tr>
        </tbody>
        <?php }} ?>
</div>

<div>
<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<div class="commentaires">
	<h2>ajouté un commentaire</h2>
	<?php  App\Core\Form::showForm($form); ?>
</div>

</div>
