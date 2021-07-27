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
<form action="/make-install" method="post">
  <label for="DBHOST">DBHOST:</label><br>
  <input type="text" id="DBHOST" name="data[DBHOST]"><br>
  <label for="DBNAME">DBNAME:</label><br>
  <input type="text" id="DBNAME" name="data[DBNAME]"><br>
  <label for="DBPREFIX">DBPREFIX:</label><br>
  <input type="text" id="DBPREFIX" name="data[DBPREFIX]"><br>
  <label for="DBUSER">DBUSER:</label><br>
  <input type="text" id="DBUSER" name="data[DBUSER]"><br>
  <label for="DBPWD">DBPWD:</label><br>
  <input type="password" id="DBPWD" name="data[DBPWD]"><br>
  <label for="DBPORT">DBPORT:</label><br>
  <input type="text" id="DBPORT" name="data[DBPORT]"><br>
  <label for="Username">Username:</label><br>
  <input type="text" id="Username" name="user[Username]"><br>
  <label for="Email">Email:</label><br>
  <input type="email" id="Email" name="user[Email]"><br>
  <label for="Password">Password:</label><br>
  <input type="password" id="Password" name="user[Password]"><br>
  <!-- <input type="hidden" id="IsDeleted" name="user[IsDeleted]" value="0"><br>
  <input type="hidden" id="Role" name="user[Role]" value="1"><br> -->
  <input type="submit" value="Submit">
</form>
</body>