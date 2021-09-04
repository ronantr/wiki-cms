<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>User Supprimer Définitivement</h1>';
        break;
    case 2:
        echo'<h1>User a été Restaurer</h1>';
        break;
}
}
?>
<h1 class="titleh1">Corbeille Utilisateur</h1>
<table>
<thead>
    <tr>
        <th>Id User</th>
        <th>Nom Prénom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Compte Validé</th>
        <th>Restaurer </th>
        <th>Supprimer Définitivement</th>

    </tr>
</thead>
<tbody>
    <?php foreach($users as $user){ 
        if ($user['isDeleted'] == 1){?>
        <tr>
            <td><?php echo $user['id']; ?> </td>
            <td><?php echo htmlspecialchars_decode($user['username']); ?> </td>
            <td><?php echo htmlspecialchars_decode($user['email']); ?> </td>
            <td><?php if($user['role'] == 1){ echo "Administrateur";}else{ echo "Utilisateur";} ?> </td>
            <td><?php if($user['emailVerified'] == 1){ echo "Verifié";}else{ echo "Non Verifié";} ?> </td>
            <td><a class="button-valide" href="/admin/users/restaurer?id=<?php echo $user['id'];?>">Restaurer</a></td>
            <td><button class="button-valide" onclick="myFunctionSupprimer()">Supprimer</button></td>
        </tr>
    <?php }} ?>
</tbody>
<script>
function myFunctionSupprimer() {
  var txt;
  var r = confirm("Voulez vous supprimer DEFINITIVEMENT cette utilisateur?");
  if (r == true) {
    document.location.href='/admin/users/delete?id=<?php echo $user['id'];?>';
  } else {
    txt = "Suppresion annuler";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>
</table>