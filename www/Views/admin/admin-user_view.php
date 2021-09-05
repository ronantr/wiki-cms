<?php foreach($users as $user){ 
    if ($user['username'] == $_GET['nom']){?>
Id User : <?php echo $user['id']; ?>
    </br>Username : <?php echo $user['username']; ?>
    </br>Email : <?php echo $user['email']; ?>
    </br>Rôle : <?php  switch($user['role']){case 1: echo "Administrateur"; break; case 2: echo "Abonné"; break; case 3: echo "Editor"; break;} ?>
    </br>Compte Validé : <?php echo($user['emailVerified'] != '1' ) ? 'Non Verifier' : 'Verifier' ;?>
    </br></br>
    <?php if($user['emailVerified'] != '1' ) {?>
    <button><a href='/admin/MailVerif'class='button-valide'> verfication email </a></button>
<?php } }} ?>