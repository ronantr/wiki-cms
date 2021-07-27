<?php 
namespace App;
use App\Core\View;
use App\Models\Page as ModelsPage;
use App\Models\Categorie;
class Page{

public function defaultAction(){
    $pages = new ModelsPage;
    $view = new View('admin/liste-page','back');
    $view->assign('pages',$pages->getUris());
    $view->assign("title","Liste Pages");

    
}

public function mainAction(){
    $view = new View("test", "front");
    
}

public function addpageAction(){
    $categorie = new Categorie;
    $view = new view('admin/add-page','back');
    $view->assign('categories',$categorie->getCategories());
    $view->assign('title','Add Page');
}

public function createAction(){
    print_r ($_POST['pagecat']);
}

}
?>