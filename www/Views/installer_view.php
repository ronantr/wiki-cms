<?php if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 1:
            echo '<h1>Connexion à la base de données impossible</h1>';
            break;
        case 2:
            echo '<h1>Erreur</h1>';
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
    <div class="flex-col">
        <form action="/make-install" method="post" class="form">
            <h1>Installeur</h1>
            <label for="DBHOST">DBHOST:</label><br>
            <input required class="form-input" type="text" id="DBHOST" name="data[DBHOST]" placeholder="Hote de la BDD"><br>
            <label for="DBNAME">DBNAME:</label><br>
            <input required class="form-input" type="text" id="DBNAME" name="data[DBNAME]" placeholder="Nom de la BDD"><br>
            <label for="DBPREFIX">DBPREFIX:</label><br>
            <input required class="form-input" type="text" id="DBPREFIX" name="data[DBPREFIX]" placeholder="Prefix de la BDD"><br>
            <label for="DBUSER">DBUSER:</label><br>
            <input required class="form-input" type="text" id="DBUSER" name="data[DBUSER]" placeholder="User BDD"><br>
            <label for="DBPWD">DBPWD:</label><br>
            <input required class="form-input" type="password" id="DBPWD" name="data[DBPWD]" placeholder="MDP BDD"><br>
            <label for="DBPORT">DBPORT:</label><br>
            <input required class="form-input" type="text" id="DBPORT" name="data[DBPORT]" placeholder="Port BDD"><br>
            <label for="Username">Username:</label><br>
            <input required class="form-input" type="text" id="Username" name="user[Username]" placeholder="Admin"><br>
            <label for="Email">Email:</label><br>
            <input required class="form-input" type="email" id="Email" name="user[Email]" placeholder="Email Admin"><br>
            <label for="Password">Password:</label><br>
            <input required class="form-input" minlength="8" type="password" id="Password" name="user[Password]" placeholder="MDP Admin"><br>
            <!-- <input type="hidden" id="IsDeleted" name="user[IsDeleted]" value="0"><br>
  <input type="hidden" id="Role" name="user[Role]" value="1"><br> -->
            <input type="submit" class="form-submit" value="Submit">
        </form>
    </div>
</body>