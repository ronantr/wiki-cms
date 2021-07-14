<div>
    <table id='tab'>
        <thead>
            <tr>
                <td>id</td>
                <td>Titre</td>
                <td>content</td>
            </tr>
        </thead>
        <tbody>
            <?php
              
                foreach($allPosts as $post){
                if($post["id"]==$_GET["id"]){
                ?>
                <tr>
                    <td><?php echo $post["id"]?></td>
                    <td><?php echo($post["title"]);?></td>
                    <td><?php echo($post["content"]);?></td>
                </tr>
        </tbody>
        <?php }} ?>
</div>