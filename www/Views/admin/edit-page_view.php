
<form action="/admin/edit-page-send" method="post">
    <label>id de la page</lable>
    <select name="id">
        <option value = <?php echo $page[0]['id'] ;?>><?php echo $page[0]['id'] ;?></option>
    </select>
    <label>Nom de la page</label>
    <input type="text" name="slug" placeholder=<?php echo $page[0]['slug'];?>  >
    <label>Url</label>
    <input type="text" name="url" placeholder=<?php echo $page[0]['url'];?> >
    <?php $comt =0;
    foreach ($categories as $categorie){
        $comt++;
        ?> <input type="checkbox" id=<?php echo $categorie['name']; ?> name="pagecat[]" value=<?php echo $categorie['id']; foreach($id_categories as $id){ if($categorie['id'] == $id['id_categorie']){ echo " checked";}}?>>
            <label for=<?php echo $categorie['name']; ?>><?php echo $categorie['name']; ?></label>
    <?php } ?>
    <button type="submit">Submit</button>
    
</form>

