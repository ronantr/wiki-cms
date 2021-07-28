<table id='tab'>
    <thead>
        <tr>
            <td>id catégorie</td>
            <td>Name</td>
            <td>Visualiser</td>

        </tr>
    </thead>
    <tbody>
        
            <?php foreach($categories as $categorie){ 
                $id = $categorie['id'];
                ?>
                <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo htmlspecialchars_decode($categorie['name']); ?></td>
                
                <td><a href="/single-categorie?id=<?php echo $id;?>">Acces Page</a></td>
    
            </tr>
            <?php } ?>
    </tbody>
</table>