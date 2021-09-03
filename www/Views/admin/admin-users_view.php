<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1 class = "erreur">User placer dans la corbeille</h1>';
        break;
    case 2:
        echo'<h1 class = "erreur">User a été modifier</h1>';
        break;
    case 3:
        echo'<h1 class = "erreur">User a été Restaurer</h1>';
        break;
    case 4;
        echo'<h1 class = "erreur">Vous ne pouvez pas supprimer le dernier Administrateur</h1>';
}
}

    if( isset($message) && $message == 3 ){
        echo '<h1>User a été Restaurer</h1>';
    }
?>
<button class="button-valide" type="button" style="font-size:20px;"><a href="/admin/users/liste-utilisateurs-deleted">Corbeille</a></button>
<table>
<thead>
    <tr>
        <th>Id User</th>
        <th>Nom Prénom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Compte Validé</th>
        <th>Edit </th>
        <th>Placer au corbeille</th>

    </tr>
</thead>
<tbody>
    <?php foreach($users as $user){ 
        if ($user['isDeleted'] == 0){?>
        <tr>
            <td><?php echo $user['id']; ?> </td>
            <td><?php echo htmlspecialchars_decode($user['username']); ?> </td>
            <td><?php echo htmlspecialchars_decode($user['email']); ?> </td>
            <td><form action="/admin/users/edit?id=<?php echo $user['id'];?>" method="POST">
                <select name="role">
                    <option value=1 <?php if($user['role'] == 1){ echo "Selected";} ?>>Administrateur</option>
                    <option value=2 <?php if($user['role'] == 2){ echo "Selected";} ?>>Abonné</option>
                    <option value=3 <?php if($user['role'] == 3){ echo "Selected";} ?>>Editor</option>
                </select> 
            </td>
            <!-- if($user['role'] == 1){ echo "Administrateur";}else{ echo "Utilisateur";} ?> -->
            <td><?php if($user['emailVerified'] == 1){ echo "Verifié";}else{ echo "Non Verifié"; ?> <button class="button-valide" type="button"><a href="/admin/valider-user?id=<?php echo $user['id'];?>">Validé</a></button> <?php } ?> </td>
            <td><input type="submit" class="button-valide" value="Edit Rôle"></td></form>
            <td><button class="button-valide" onclick="myFunctionSupprimer(<?php echo $user['id'];?>)">Corbeille</button>
            <!--<a href="/admin/users/delete?id=<?php //echo $user['id'];?>">Supprimer</a>--></td>
        </tr>
    <?php }} ?>
</tbody>
<script>
function myFunctionSupprimer(id) {
  var txt;
  var r = confirm("Voulez vous supprimer cette utilisateur?");
  if (r == true) {
    document.location.href="/admin/users/delete?id="+id;
  } else {
    txt = "Suppresion annuler";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>
</table>