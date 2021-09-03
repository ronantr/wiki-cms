<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>Le Commentaire a été supprimé</h1>';
        break;
    case 2:
        echo'<h1>Le Commentaire a été ajouté</h1>';
        break;
    case 3:
        echo'<h1>Le Commentaire a été modifié</h1>';
        break;
}
}
?><div>
    <h1 class="titleh1">Commentaires</h1>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>id_User</td>
                <td>id_Post</td>
                <td>Content</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($allCommentaires as $Commentaire){
                //$id = $value["id"];
                //echo($allCommentaires);
                ?>
                <tr>
                <td><?php echo $Commentaire["id"]?></td>
                    <td><?php echo($Commentaire["id_article"]);?></td>
                    <td><?php echo($Commentaire["id_user"]);?></td>
                    <td><?php echo(htmlspecialchars_decode($Commentaire["content"]));?></td>
                    <td><button class="button-valide"><a href="\admin\post?id=<?php echo $Commentaire["id_article"];?>">affichier</a></button> <button class="button-valide"><a href="\admin\delete-commentaire?id=<?php echo $Commentaire["id"];?>">supprimer</a> </button> <button class="button-valide"><a href="\admin\edit-commentaire?id=<?php echo $Commentaire["id"];?>"> editer<a></button>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>