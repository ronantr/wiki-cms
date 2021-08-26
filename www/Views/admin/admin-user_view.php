<?php foreach($users as $user){ 
    if ($user['username'] == $_GET['nom']){?>
Id User : <?php echo $user['id']; ?>
    </br>Username : <?php echo $user['username']; ?>
    </br>Email : <?php echo $user['email']; ?>
    </br>Rôle : <?php echo $user['role']; ?>
    </br>Compte Validé : <?php echo $user['emailVerified']; ?>
    </br></br>
    <?php var_dump($_SESSION);?>
    <button> verfication email </button>
<?php } } ?>