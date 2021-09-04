
<form action="/admin/edit-page-send" method="post">
    <label>id de la page</lable>
    <select name="id">
        <option value = <?php echo $page[0]['id'] ;?>><?php echo $page[0]['id'] ;?></option>
    </select>
    <label>Nom de la page</label>
    <input type="text" name="slug" placeholder=<?php echo $page[0]['slug'];?> minlength="4" maxlength="25" >
    <label>Url</label>
    <input type="text" name="url" placeholder=<?php echo $page[0]['url'];?> minlength="4" maxlength="50">
    <label>Content</label>
    <textarea id="content" class="" name="content" type="mytextarea" style="visibility: hidden;" aria-hidden="true" defaultValue=<?php echo htmlspecialchars_decode($page[0]['content']);?>  </textarea>
    
    <?php $comt =0;
    foreach ($categories as $categorie){
        $comt++;
        ?> <input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; foreach($id_categories as $id){ if($categorie['id'] == $id['id_categorie']){ echo " checked";}}?>>
            <label for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label>
    <?php } ?>
    <label>Status</label>
    <select name="status">
        <option value=0 <?php if($page[0]['status'] == 0){ echo" selected";} ?>>Publié</option>
        <option value=1 <?php if($page[0]['status'] == 1){ echo" selected";} ?>>Brouillon</option>
    </select>
    <button type="submit">Submit</button>
    
</form>

