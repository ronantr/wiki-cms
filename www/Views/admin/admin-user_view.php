
<center><?php foreach($users as $user){ 
    if ($user['username'] == $_SESSION['username']){?>
<h1>Id User : <?php echo $user['id']; ?>
    <h1>Username : <?php echo $user['username']; ?></h1>
    <h1>Email : <?php echo $user['email']; ?></h1>
    <h1>Rôle : <?php  switch($user['role']){case 1: echo "Administrateur"; break; case 2: echo "Abonné"; break; case 3: echo "Editor"; break;} ?></h1>
    <h1>Compte Validé : <?php echo($user['emailVerified'] != '1' ) ? 'Non Verifier' : 'Verifier' ;?></h1>
    </br></br>
    <?php if($user['emailVerified'] != '1' ) {?>
    <button><a href='/admin/MailVerif'class='button-valide'> verfication email </a></button>
<?php } }} ?></center>
