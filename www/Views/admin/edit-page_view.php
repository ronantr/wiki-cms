
<form action="/admin/edit-page-send" method="post" class="form-box">
    <h1 class="titleh1">Modification Page N°<?php echo $page[0]['id'] ;?></h1>
    <div class="label-input-group" style="display:none;">
        <label for="id" class="label-form">id de la page</lable>
        <select name="id" id="id" style="appearance:none;border:none;">
            <option value = <?php echo $page[0]['id'] ;?>><?php echo $page[0]['id'] ;?></option>
        </select><br>
    </div>
    <div class="label-input-group">
        <label class="label-form">Nom de la page</label>
        <input class="input-form" type="text" name="slug" placeholder=<?php echo $page[0]['slug'];?> minlength="4" maxlength="25" ><br>
    </div>
    <div class="label-input-group">
        <label class="label-form">Url</label>
        <input class="input-form" type="text" name="url" placeholder=<?php echo $page[0]['url'];?> minlength="4" maxlength="50"><br>
    </div>

    <label class="label-form">Content</label>
    <textarea id="content" class="" name="content" type="mytextarea" style="visibility: hidden;" aria-hidden="true" defaultValue= <?php if(!empty($page[0]['content'])){echo htmlspecialchars_decode($page[0]['content']);}else{echo"(Vide)";} ?>  </textarea></textarea>
    
    <div class="separateur"></div>
    <label class="label-form">Les Catégories :</label><br>
    <div class="checkbox-form">
        <?php $comt =0;
        foreach ($categories as $categorie){
            $comt++;
            ?> <div class="checkbox-option-form"><input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; foreach($id_categories as $id){ if($categorie['id'] == $id['id_categorie']){ echo " checked";}}?>>
                <label class="label-form-checkbox" for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label></div>
        <?php } ?>
    </div> <small>Les articles des catégories seront affichiés en bas de la page . </small></br>
    <div class="separateur"></div>
    <div class="label-input-group">
        <label class="label-form">Status</label>
        <select name="status" class="select-form">
            <option value=0 <?php if($page[0]['status'] == 0){ echo" selected";} ?>>Publié</option>
            <option value=1 <?php if($page[0]['status'] == 1){ echo" selected";} ?>>Brouillon</option>
        </select>
    </div>
    <div class="separateur"></div>
    <button type="submit" class="button-form">Submit</button>
    
</form>

