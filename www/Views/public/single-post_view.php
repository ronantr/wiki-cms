<div class = "center"><h1><?php echo htmlspecialchars_decode($post[0]['title']); ?></h1> </div>
    
    <?php echo htmlspecialchars_decode($post[0]['content']);
var_dump($commentaires);
foreach($commentaires as $commentaire){
    if ($post[0]['id'] == $commentaire['id_article']){
        ?>


<?php
    }
} ?>