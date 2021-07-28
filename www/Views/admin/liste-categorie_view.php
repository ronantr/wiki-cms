<div class="flex-col">
    <form action="/admin/add-categorie" method="post" class="form">
        <label>New Catégorie</label>
        <input name="name" class="form-input" placeholder="Nom de catégorie" type="text">
        <button type="submit" class="form-submit">Add Catégorie</button>
    </form>
</div>
<table class='flex-col mt-50'>
    <thead>
        <tr>
            <td>id Catégorie</td>
            <td>Name</td>
            <td>Date de création</td>
            <td>Supprimer</td>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($categories as $cat) { ?>
            <tr>
                <td><?php echo $cat['id']; ?></td>
                <td><?php echo htmlspecialchars_decode($cat['name']); ?></td>
                <td><?php echo $cat['creatAt']; ?></td>
                <td><a href="/admin/cat-delete?id=<?php echo $cat['id']; ?>">Supprimer</a></td>

            </tr>
        <?php } ?>
    </tbody>
</table>