

<form action="/admin/add-page-send" method="post">
    <label>Nom de la page</label>
    <input type="text" name="slug" required>
    <label>Url</label>
    <input type="text" name="url" placeholder="votreurl" required>
    <?php $comt =0;
    foreach ($categories as $categorie){
        $comt++;
        ?> <input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; ?>>
            <label for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label>
    <?php } ?>
    <button type="submit">Submit</button>
    
</form>