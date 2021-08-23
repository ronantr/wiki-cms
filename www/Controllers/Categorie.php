<?php 
namespace App;
use App\Core\View;
use App\Models\Categorie as ModelsCategorie;

class Categorie{

    public function defaultAction(){
        $categories = new ModelsCategorie;
        $cats = $categories->getCategories();
        $view = new View('admin/liste-categorie','back');
        $view->assign("title","Admin Liste Categorie");
        $view->assign('categories',$cats);
    }

    public function addAction(){
        $name = htmlspecialchars($_POST['name']);
        $categories = new ModelsCategorie;
        $categories->setname($name);
        $categories->save();
        header('Location: /admin/liste-categorie');
    }

    public function deleteAction(){
        $id_cat = $_GET['id'];
        $categories = new ModelsCategorie;
        $categories->deleteCat($id_cat);
        header('Location: /admin/liste-categorie');
    }
}