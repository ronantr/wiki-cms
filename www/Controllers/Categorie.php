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
        $categories->createCat($name);
        header('Location: /admin/liste-categorie');
    }

    public function deleteAction(){
        $id_cat = $_GET['id'];
        $categories = new ModelsCategorie;
        $categories->deleteCat($id_cat);
        header('Location: /admin/liste-categorie');
    }

    public function publiccategorieAction(){
        $categories = new ModelsCategorie;
        $view = new View('public/liste-categorie','front');
        $view->assign('categories',$categories->getCategories());
        $view->assign("title","Liste Catégorie");
    }

    public function public_single_categorieAction(){
        $id_cat = $_GET['id'];
        $cat = new ModelsCategorie;
        $posts = $cat->getallpostbycat($id_cat);
        $view = new View('public/single-categorie','front');
        $view->assign('posts', $posts);
        $view->assign("title","Catégories");
    }
}