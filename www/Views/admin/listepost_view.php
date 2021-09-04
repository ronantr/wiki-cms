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
                    <td><a class="button-valide" href="\post?id=<?php echo $id;?>">Affichier</a></td>
                    <td><button class="button-valide" onclick="myFunctionSupprimer(<?php echo $id;?>)">Supprimer</button></td>
                    <td><a class="button-valide" href="\admin\edit-post?id=<?php echo $id;?>"> Editer<a></td>
                    <td><button type="submit" class="button-valide">Change Catégorie</button></form></td>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>
<script>
function myFunctionSupprimer(id) {
  var txt;
  var r = confirm("Voulez vous supprimer cette article ?");
  if (r == true) {
    document.location.href="/admin/delete-post?id="+id;
  } else {
    txt = "Suppresion annuler";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>