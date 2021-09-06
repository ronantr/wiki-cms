
<center><?php foreach($users as $user){ 
    if ($user['username'] == $_SESSION['username']){?>
<h1>Id User : <?php echo $user['id']; ?>
    <h1>Username : <?php echo $user['username']; ?></h1>
    <h1>Email : <?php echo $user['email']; ?></h1>
    <h1>Rôle : <?php  switch($user['role']){case 1: echo "Administrateur"; break; case 2: echo "Abonné"; break; case 3: echo "Editor"; break;} ?></h1>
    <h1>Compte Validé : <?php echo($user['emailVerified'] != '1' ) ? 'Non Verifier' : 'Verifier' ;?></h1>
    </br></br>
    <?php if($user['emailVerified'] != '1' ) {?>


    <?php if(isset($_GET['message'])){ ?>
        <button><a href=''class='button-valide'> Mail envoyé </a></button> <?php } else { ?> <button><a href='/MailVerif'class='button-valide'> verfication email </a></button>  <?php } ?>


<?php } }} ?>

<?php if (isset($_GET['message'])){
    switch ($_GET['message']){
    case 1:
        echo'<h1 class = "erreur">Un Mail a été envoyé dans votre boîte au mail ( PEUT ETRE DANS INDESIRABLE )</h1>';
        break;
    case 2:
        echo'<h1 class = "</h1>';
        break;
    case 3:
        echo'<h1 class = "erreur"></h1>';
        break;
    case 4;
        echo'<h1 class = "erreur"></h1>';
}
} ?>
</center>

