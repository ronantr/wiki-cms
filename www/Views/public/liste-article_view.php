<table id='tab'>
    <thead>
        <tr>
            <td>id article</td>
            <td>Name</td>
            <td>Visualiser</td>

        </tr>
    </thead>
    <tbody>
        
            <?php foreach($posts as $post){ 
                $id = $post['id'];
                if($post['isDeleted'] == 0){
                    ?>
                    <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo htmlspecialchars_decode($post['title']); ?></td>
                    
                    <td><a href="/single-post?id=<?php echo $id;?>">Acces Post</a></td>
        
                </tr>
            <?php }} ?>
    </tbody>
</table>