
<h1 class="titleh1">choose template</h1>

<form action="/admin/theme/edit"method="POST" class="form-box">
<select name="templates" id="templates" class="select-form">
    <?php foreach($themes as $theme){ ?>
    <option value=<?php echo $theme['id']; ?> <?php if($theme['actif'] == 1){ echo "Selected";}?> ><?php echo $theme['title']; ?></option>
    <
    <?php } ?>

</select>

<input class="button-valide" type="submit" value="Submit">
</form>
