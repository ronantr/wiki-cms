<table id='tab'>
    <thead>
        <tr>
            <td>id page</td>
            <td>Name</td>
            <td>Url</td>
            <td>Visualiser</td>

        </tr>
    </thead>
    <tbody>
        
            <?php foreach($pages as $page){ 
                $id = $page['id'];
                ?>
                <tr>
                <td><?php echo $page['id']; ?></td>
                <td><?php echo htmlspecialchars_decode($page['slug']); ?></td>
                <td>/<?php echo htmlspecialchars_decode($page['url']); ?></td>
                
                <td><a href="/single-page?id=<?php echo $id;?>">Acces Page</a></td>
    
            </tr>
            <?php } ?>
    </tbody>
</table>
