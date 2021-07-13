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
            foreach($allPosts as $key => $value){
                $html = "
                <tr>
                    <td>".($value["id"])."</td>
                    <td>".($value["title"])."</td>
                    <td>".($value["content"])."</td>
                </tr>";
                echo $html;
            }
            ?>
        </tbody>
</div>