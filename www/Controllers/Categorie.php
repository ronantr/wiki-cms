<?php 
namespace App;
use App\Core\Security as coreSecurity;
use App\Core\View;
use App\Models\Categorie as ModelsCategorie;

class Categorie{

    public function defaultAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $categories = new ModelsCategorie;
        $cats = $categories->getCategories();
        $view = new View('admin/liste-categorie','back');
        $view->assign("title","Admin Liste Categorie");
        $view->assign('categories',$cats);
    }

    public function addAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $name = htmlspecialchars($_POST['name']);
        $categories = new ModelsCategorie;
        $categories->createCat($name);
        header('Location: /admin/liste-categorie');
    }

    public function deleteAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $id_cat = $_GET['id'];
        $categories = new ModelsCategorie;
        $categories->deleteCat($id_cat);
        header('Location: /admin/liste-categorie');
    }
}