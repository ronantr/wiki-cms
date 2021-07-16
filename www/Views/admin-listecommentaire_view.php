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
                    <td><?php echo($Commentaire["content"]);?></td>
                    <td><a href="\commentaire?id=<?php echo $id;?>">affichier</a> <a href="\delete-commentaire?id=<?php echo $id;?>">supprimer</a> <a href="\edit-commentaire?id=<?php echo $id;?>"> editer<a>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>