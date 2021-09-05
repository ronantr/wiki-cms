<?php 
namespace App;
use App\Core\Security as coreSecurity;
use App\Core\View;
use App\Core\Form;
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

        if(!empty($_POST['name'])){
            $categories = new ModelsCategorie;
            $name = htmlspecialchars($_POST['name']);
            if($categories->existebd($name,'categorie','name')){
                $cats = $categories->getCategories();
                $view = new View('admin/liste-categorie','back');
                $view->assign("title","Admin Liste Categorie");
                $view->assign('categories',$cats);
                $view->assign('erreur','Name Existe');
            }
            else{
                $categories->setname($name);
                $categories->save();
                header('Location: /admin/liste-categorie');
            }
        }
        else{
            header('Location: /admin/liste-categorie');
        }
        
        
    }

    public function deleteAction(){
        if(!empty($_GET['id'])){
            $id_cat = $_GET['id'];
            $categories = new ModelsCategorie;
            $categories->deleteCat($id_cat);
            header('Location: /admin/liste-categorie');    
        }
        else{
            $this->returnAction("Action Impossible");
        }
        
    }

    public function returnAction($erreur){

        $categories = new ModelsCategorie;
        $cats = $categories->getCategories();
        $view = new View('admin/liste-categorie','back');
        $view->assign("title","Admin Liste Categorie");
        $view->assign('categories',$cats);
        $view->assign('erreur',$erreur);
    }

    public function editAction(){
        if(!empty($_GET['id'])){
            $categories = new ModelsCategorie;
            $cat = $categories->getCategoriesid($_GET['id']);
            $categories->setname($cat['name']);
            $categories->setId($cat['id']);
            $form = $categories->buildFormcategorie();
            $view= new View("admin/edit-categorie","back");
            $view->assign("form", $form);
            if(!empty($_POST)){
                $errors = Form::validator($_POST, $form);
                if(empty($errors)){
                    if(count($_POST) ==1){
                        
                        $categories->setId($_GET['id']);
                        $categories->setname(htmlspecialchars($_POST['name']));
                        $categories->save();
                        header('Location: /admin/liste-categorie');
                    }
                    else{
                        echo "Tentative Hack XSS";
                    }
                }
                else{
                    $view->assign("formErrors", $errors);
                }
                
            }
        }
        else{
            header('Location: /admin/liste-categorie');
        }
        
}
}