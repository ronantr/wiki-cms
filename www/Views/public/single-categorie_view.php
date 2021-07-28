<?php 

if(!empty($posts)){
    foreach($posts as $post){
        ?><h1><?php echo htmlspecialchars_decode($post['title']); ?></h1> 
        <p>(Catégorie : <?php echo htmlspecialchars_decode($post['name']); ?>)</p>
        <?php echo htmlspecialchars_decode($post['content']);
    } 
}
else{
    echo "<h1>Cette Page ne dispose pas d'élément <h1>";
}

