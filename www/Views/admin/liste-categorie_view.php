<form action="/admin/add-categorie" method="post">
    <label>New Catégorie</label>
    <input name="name" type="text">
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
            <td><?php echo $cat['name']; ?></td>
            <td><?php echo $cat['creatAt']; ?></td>
            <td><a href="/admin/cat-delete?id=<?php echo $cat['id'];?>">Supprimer</a></td>
        
        </tr>
        <?php } ?>
    </tbody>
</table>