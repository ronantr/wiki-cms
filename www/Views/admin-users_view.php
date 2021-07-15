<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>User placer dans la corbeille</h1>';
        break;
    case 2:
        echo'<h1>User a été modifier</h1>';
        break;
}
}
?>

<table>
<thead>
    <tr>
        <th>Id User</th>
        <th>Nom Prénom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Compte Validé</th>
        <th>Edit </th>
        <th>Supprimer</th>

    </tr>
</thead>
<tbody>
    <?php foreach($users as $user){ 
        if ($user['isDeleted'] == 0){?>
        <tr>
            <td><?php echo $user['id']; ?> </td>
            <td><?php echo $user['username']; ?> </td>
            <td><?php echo $user['email']; ?> </td>
            <td><?php if($user['role'] == 1){ echo "Administrateur";}else{ echo "Utilisateur";} ?> </td>
            <td><?php if($user['emailVerified'] == 1){ echo "Verifié";}else{ echo "Non Verifié";} ?> </td>
            <td><a href="/admin/users-edit?id=<?php echo $user['id'];?>">Modifier</a></td>
            <td><a href="/admin/users-delete?id=<?php echo $user['id'];?>">Supprimer</a></td>
        </tr>
    <?php }} ?>
</tbody>
</table>