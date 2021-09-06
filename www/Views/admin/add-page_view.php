


<form action="/admin/add-page-send" method="post" class="form-box">
    <h1 class="titleh1">Creation Page</h1>
    <div class="label-input-group">
        <label for="slug" class="label-form">Nom de la page*</label>
        <input class="input-form" type="text" id="slug" name="slug" minlength="4" maxlength="25" required><br>
    </div>
    <div class="label-input-group">
        <label for="url" class="label-form">Url*</label>
        <input type="text" id="url" class="input-form" name="url" placeholder="votreurl" minlength="4" maxlength="50" required><br>
    </div>
    
    <label class="label-form">Content</label>
    
    <textarea id="content" class="" name="content" type="mytextarea" placeholder="Contenue" style="visibility: hidden;" aria-hidden="true" ></textarea>
    <div class="separateur"></div>
    <label class="label-form">Les Catégories :</label><br>
    <div class="checkbox-form">
    <?php $comt =0;
    if(!empty($categories)){
        foreach ($categories as $categorie){
        $comt++;
        ?> <div class="checkbox-option-form"><input type="checkbox" id=<?php echo htmlspecialchars_decode($categorie['name']); ?> name="pagecat[]" value=<?php echo $categorie['id']; ?>>
            <label class="label-form-checkbox" for=<?php echo htmlspecialchars_decode($categorie['name']); ?>><?php echo htmlspecialchars_decode($categorie['name']); ?></label></div>
    <?php }}
    else{ ?> <a href="/admin/liste-categorie" class="button-valide">Catégorie Vide -> Création Catégorie</a> <?php } ?>
    
    

       </div> <small>Les articles des catégories seront affichiés en bas de la page . </small></br>
    <div class="separateur"></div>
    <div class="label-input-group">
        <label class="label-form">Status</label>
        <select name = "status" class="select-form">
            <option value = 0 >Publié</option>
            <option value = 1>Brouillon</option>
        </select>
    </div>
    <small>Les Pages qui ont status brouillon ne seront pas accessible par URL </small>
    <div class="separateur"></div>
    <button type="submit" class="button-form">Submit</button>
    
</form>
<div class="separateur"></div>