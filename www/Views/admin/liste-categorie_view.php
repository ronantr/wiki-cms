<h1 class="titleh1">Catégorie</h1>
<form action="/admin/add-categorie" method="post" class="cat_form">
    <label>New Catégorie</label>
    <input name="name" type="text" minlength="4" maxlength="25" required>
    <button type ="submit">Add Catégorie</button>
</form>
<table id='tab'>
    <thead>
        <tr>
            <td>id Catégorie</td>
            <td>Name</td>
            <td>Date de création</td>
            <td>Supprimer</td>
        </tr>
    </thead>
    <tbody>
        
        <?php foreach($categories as $cat){ ?>
        <tr>
            <td><?php echo $cat['id']; ?></td>
            <td><?php echo htmlspecialchars_decode($cat['name']); ?></td>
            <td><?php echo $cat['creatAt']; ?></td>
            <td><button class="button-valide" onclick="myFunctionSupprimer(<?php echo $cat['id'];?>)">Supprimer</button></td>
        
        </tr>
        <?php } ?>
    </tbody>
</table>
<script>
function myFunctionSupprimer(id) {
  var txt;
  var r = confirm("Voulez vous supprimer cette catégorie ?");
  if (r == true) {
    document.location.href="/admin/cat-delete?id="+id;
  } else {
    txt = "Suppresion annuler";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>