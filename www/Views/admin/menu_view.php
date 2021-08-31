<?php if(!empty($_GET['erreur'])){ ?> 
<h1 class = "erreur"><?php echo $_GET['erreur'] ?></h1>
<?php } ?>

<section class = "section_menu">
    <div class="demi">
        <table>
            
            <tbody>
                <?php foreach($pages as $page){
                    if ($page['isMenu'] == 0){?>
                <tr>
                    <td><?php echo htmlspecialchars_decode($page['slug']); ?>
                    <td><form action="/admin/menu/add" method="post"><input type="hidden" name="id" value="<?php echo $page['id']; ?>"><button type ="submit" class="button-valide" >Add Menu</button></form></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
    <div class="demi">
        <h1 class = "center">Menu</h1>
        <table>
            <tbody>
                <?php foreach($pages as $page){ 
                    if ($page['isMenu'] == 1 || $page['isAccueil'] == 1 ){?>
                    <tr>
                        <td><?php echo htmlspecialchars_decode($page['slug']); ?>
                        <td><form action="/admin/menu/remove" method="post"><input type="hidden" name="id" value="<?php echo $page['id']; ?>"><button type ="submit" class="button-valide" >Remove</button></form></td>
                        <?php if($page['isAccueil'] == 1){ ?>
                            <td><button type ="button" class="button-valide" >Page d'Accueil</button></td> 
                        <?php }?> 
                        <?php if($page['isAccueil'] == 0){ ?>                       
                            <td><form action="/admin/menu/is_Accueil" method="post"><input type="hidden" name="id" value="<?php echo $page['id']; ?>"><button type ="submit" class="button-valide" >Is Accueil</button></form></td> 
                        <?php }?> 
                    </tr>
                    <?php }} ?>
            </tbody>
        </table>
    </div>
</section>
