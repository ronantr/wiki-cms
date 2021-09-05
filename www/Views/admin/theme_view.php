<label for='template'>choose template</label>
<?php foreach($themes as $theme){ ?>
<form action="/admin/theme/edit"method="POST">
<select name="templates" id="templates">
    <option value=1 <?php if($theme['id'] == 1){ echo "Selected";}?> >white</option>
    <option value=2 <?php if($theme['id'] == 2){ echo "Selected";}?> >black</option>
    <?php } ?>
</select>

<input type="submit" value="Submit">
</form>
