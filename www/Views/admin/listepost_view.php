<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>Le Post a été supprimé</h1>';
        break;
    case 2:
        echo'<h1>Le Post a été ajouté</h1>';
        break;
    case 3:
        echo'<h1>Le Post a été modifié</h1>';
        break;
}
}
?><div>
    <h1 class="titleh1">Posts</h1>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>Titre</td>
                <td>Catégorie</td>
                <td>Affichage</td>
                <td>Delete</td>
                <td>Modification</td>
                <td>Edit Catégorie</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($allPosts as $key => $value){
                $id = $value["id"];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo($value["title"]);?></td>
                    <td><form action="\admin\edit-cat-post?id=<?php echo $id;?>" method="post"><select name="categorie" style="padding:10px;">
                            <option value="">...</option>
                    <?php 
                        foreach($categories as $categorie){
                            $id_cat = $categorie['id'];
                            $name_cat = htmlspecialchars_decode($categorie['name']);
                            ?> <option value= <?php echo $id_cat; if($categorie['id'] == $value['id_categorie']){ echo " selected";} ?> ><?php echo $name_cat ;?></option>
                            <?php
                        }
                    ?>
                    </select></td>
                    <td><button class="button-valide"><a href="\post?id=<?php echo $id;?>">affichier</a></button></td>
                    <td><button class="button-valide"><a href="\admin\delete-post?id=<?php echo $id;?>">supprimer</a></button></td>
                    <td><button class="button-valide"><a href="\admin\edit-post?id=<?php echo $id;?>"> editer<a></button></td>
                    <td><button type="submit" class="button-valide">Change Catégorie</button></form></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>