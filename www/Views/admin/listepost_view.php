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
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>Titre</td>
                <td>content</td>
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
                    <td><?php echo(htmlspecialchars_decode($value["content"]));?></td>
                    <td><form action="\admin\edit-cat-post?id=<?php echo $id;?>" method="post"><select name="categorie">
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
                    <td><a href="\post?id=<?php echo $id;?>">affichier</a></td>
                    <td><a href="\admin\delete-post?id=<?php echo $id;?>">supprimer</a></td>
                    <td><a href="\admin\edit-post?id=<?php echo $id;?>"> editer<a></td>
                    <td><button type="submit">Change Catégorie</button></form></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>