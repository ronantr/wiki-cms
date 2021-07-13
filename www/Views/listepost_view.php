<div>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>Titre</td>
                <td>content</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($allPosts as $key => $value){
                $id = $value["id"];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo($value["title"]);?></td>
                    <td><?php echo($value["content"]);?></td>
                    <td><a href="\post\<?php echo $id;?>">affichier</a> <a href="\post\<?php echo $id;?>">supprimer</a> <a href="\post\<?php echo $id;?>"> editer<a>

                </tr>
                <?php 
            }
            ?>
        </tbody>
</div>