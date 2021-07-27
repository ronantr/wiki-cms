<?php foreach($users as $user){ 
    if ($user['email'] == $_POST['user_email']){?>
Id User : <?php echo $user['id']; ?>
</td>Username :<?php echo $user['username']; ?>
</td>Email :<?php echo $user['email']; ?>
</td>Rôle : <?php echo $user['role']; ?>
</td>Compte Validé :<?php echo $user['emailVerified']; ?>
<?php } } ?>