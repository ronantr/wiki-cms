<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1>Connexion à la base de données impossible</h1>';
        break;
    case 2:
        echo'<h1>Errer</h1>';
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport">
</head>
<body>
    <div class='containermargin'>
    
<form action="/make-install" method="post" class='form-box' id='form_login' style="width:50%;">
    <div class="label-input-group">
        <label class="label-form" for="DBHOST">DBHOST:</label><br>
        <input type="text" id="DBHOST" class='input-form' name="data[DBHOST]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="DBNAME">DBNAME:</label><br>
        <input type="text" id="DBNAME" class='input-form' name="data[DBNAME]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="DBPREFIX">DBPREFIX:</label><br>
        <input type="text" id="DBPREFIX" class='input-form' name="data[DBPREFIX]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="DBUSER">DBUSER:</label><br>
        <input type="text" id="DBUSER" class='input-form' name="data[DBUSER]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="DBPWD">DBPWD:</label><br>
        <input type="password" id="DBPWD" class='input-form' name="data[DBPWD]" required><br></div>
    <div class="label-input-group">    
        <label class="label-form"   for="DBPORT">DBPORT:</label><br>
        <input type="text" id="DBPORT" class='input-form' name="data[DBPORT]" required><br></div>
    <!-- <div class="label-input-group">
        <label class="label-form"   for="Username">Username:</label><br>
        <input type="text" id="Username" class='input-form' name="user[Username]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="Email">Email:</label><br>
        <input type="email" id="Email" class='input-form' name="user[Email]" required><br></div>
    <div class="label-input-group">
        <label class="label-form"   for="Password">Password:</label><br>
        <input type="password" id="Password" class='input-form' name="user[Password]" required><br></div>
     -->
    <!-- <input type="hidden" id="IsDeleted" name="user[IsDeleted]" value="0"><br>
    <input type="hidden" id="Role" name="user[Role]" value="1"><br> -->
    <input type="submit" value="Submit">
</form>
    
</div>
</body>