<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>Votre Page a été ajouter</h1>';
        break;
    case 2:
        echo'<h1>Votre Page a été Modifier</h1>';
        break;
    case 3:
        echo'<h1>Votre Page a été Supprimer</h1>';
        break;
    case 4:
        echo'<h1>Url Existant</h1>';
        break;
}
}
?>
<table id='tab'>
    <thead>
        <tr>
            <td>id page</td>
            <td>Name</td>
            <td>Url</td>
            <td>Date Création</td>
            <td>Status</td>
            <td>Edit</td>
            <td>Supprimer</td>
        </tr>
    </thead>
    <tbody>
        
            <?php foreach($pages as $page){ 
                $id = $page['id'];
                ?>
                <tr>
                <td><?php echo $page['id']; ?></td>
                <td><?php echo htmlspecialchars_decode($page['slug']); ?></td>
                <td>/<?php echo htmlspecialchars_decode($page['url']); ?></td>
                <td><?php echo $page['createdAt']; ?></td>
                <?php switch($page['status']){
                        case 0 :
                            echo "<td>Publié</td>";
                            break;
                        case 1 :
                            echo "<td>Brouillon</td>";
                            break;
                        case 2 :
                            echo "<td>Deleted</td>";
                            break;
                } ?>
                <td><a href="/admin/page-edit?id=<?php echo $id;?>">Modifier</a></td>
                <td><a href="/admin/page-delete?id=<?php echo $id;?>">Supprimer</a></td>
            </tr>
            <?php } ?>
    </tbody>
</table>
