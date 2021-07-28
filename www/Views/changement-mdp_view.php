<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo"<h1>erreur lors de l'envoi du mail</h1>";
        break;
    case 2:
        echo"<h1> Ce mail n'existe pas dans la base de données</h1>";
        break;
}}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport">
</head>
<body>
    <h1>Récuperation de PASSWORD</h1>
<?php  App\Core\Form::showForm($form); ?>
</body>