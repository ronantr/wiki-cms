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
                $html = "
                <tr>
                    <td>".($value["id"])."</td>
                    <td>".($value["title"])."</td>
                    <td>".($value["content"])."</td>
                    <td><a href=\post\'".($value["id"])."'>affichier<a> <a href=\post\'".($value["id"])."'> supprimer<a> <a href=\post\'".($value["id"])."'> editer<a>
                </tr>";
                echo $html;
            }
            ?>
        </tbody>
</div>