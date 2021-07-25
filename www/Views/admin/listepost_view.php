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
                <td>action</td>
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
                    <td><?php echo($value["content"]);?></td>
                    <td><a href="\admin\post?id=<?php echo $id;?>">affichier</a> <a href="\admin\delete-post?id=<?php echo $id;?>">supprimer</a> <a href="\admin\edit-post?id=<?php echo $id;?>"> editer<a>
                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>