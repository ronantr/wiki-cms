


<form action="/admin/add-page-send" method="post">
    <label>Nom de la page</label>
    <input type="text" name="slug" required><br>
    <label>Url</label>
    <input type="text" name="url" placeholder="votreurl" required><br>
    <label>Content</label>
    
    <textarea id="content" class="" name="content" type="mytextarea" placeholder="Contenue" style="visibility: hidden;" aria-hidden="true" ></textarea>
    <label>Les Catégories :</label><br>
    <?php $comt =0;
    foreach ($categories as $categorie){
        $comt++;
        ?> <input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; ?>>
            <label for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label>
    <?php } ?><br>
    <label>Status</label>
    <select name = "status">
        <option value = 0 >Publié</option>
        <option value = 1>Brouillon</option>
    </select><br>

    <button type="submit">Submit</button>
    
</form>