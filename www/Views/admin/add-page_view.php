<div class="flex-col">

    <form action="/admin/add-page-send" method="post" class="form flex-col">
        <label>Nom de la page</label>
        <input type="text" name="slug" placeholder="Page" class="form-input" required>
        <label>Url</label>
        <input type="text" name="url" placeholder="URL" class="form-input" required>
        <?php $comt = 0;
        foreach ($categories as $categorie) {
            $comt++;
        ?> <input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; ?>>
            <label for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label>
        <?php } ?>
        <button type="submit" class="form-submit">Submit</button>

    </form>
</div>