<div class = "center"><h1><?php echo htmlspecialchars_decode($post[0]['title']); ?></h1> </div>
    
    <?php echo htmlspecialchars_decode($post[0]['content']);

?> <section class="section-commentaire">
        <h1 class="titleh1"> Commentaires</h1>
        <table>
            <thead>
                <tr>
                    <td style="font-size:15px;padding:0px;text-align:start;">Nombre de Commentaire : <?php echo count($commentaires); ?></td>
                    <td>Discussion</td>
                </tr>
            </thead>
            <tbody><?php
foreach($commentaires as $commentaire){
    if ($post[0]['id'] == $commentaire['id_article']){
        ?>    
        <tr>
            <td>
                <h2><?php echo ucfirst($commentaire['username']);?></h2>
                <p>Date de publication: <?php echo $commentaire['createdAt'];?> </p>
            </td>
            <td>
                <?php echo htmlspecialchars_decode($commentaire['content']);?>
            </td>
        </tr>

<?php
    }
} ?>
        </tbody>
    </table>
    <section class="section-commenter">
        <h1 class="titleh1" style="font-size:2rem;">Ecrire une commentaire</h1>
        <?php if(App\Core\Security::isConnected()){
            if($user['role'] == 2 && $user['emailVerified'] == 0){
                ?> <div style="width:100%;"><a href="/moncompte" class="button-valide">Verifier votre Email</a></div> <?php
            }
            else{App\Core\Form::showForm($form);}
        }
        else{
            ?> <div style="width:100%;"><a href="/login" class="button-valide">Login pour commenter</a></div> <?php
        }
        ?>
       
        <!-- <h1 class="titleh1" style="font-size:2rem;">Ecrire une commentaire</h1>
        <input name="content" class="input-form" placeholder="Maximun 200 Caractère"> -->
    </section>
</section>
