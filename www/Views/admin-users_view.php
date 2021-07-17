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
<button type="button"><a href="/admin/liste-utilisateurs-deleted">Corbeille</a></button>
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
            <td><form action="/admin/users-edit?id=<?php echo $user['id'];?>" method="POST">
                <select name="role">
                    <option value=1 <?php if($user['role'] == 1){ echo "Selected";} ?>>Administrateur</option>
                    <option value=2 <?php if($user['role'] == 2){ echo "Selected";} ?>>Abonné</option>
                    <option value=3 <?php if($user['role'] == 3){ echo "Selected";} ?>>Editor</option>
                </select> 
            </td>
            <!-- if($user['role'] == 1){ echo "Administrateur";}else{ echo "Utilisateur";} ?> -->
            <td><?php if($user['emailVerified'] == 1){ echo "Verifié";}else{ echo "Non Verifié";} ?> </td>
            <td><input type="submit" value="Edit Rôle"></td></form>
            <td><a href="/admin/users-delete?id=<?php echo $user['id'];?>">Supprimer</a></td>
        </tr>
    <?php }} ?>
</tbody>
</table>