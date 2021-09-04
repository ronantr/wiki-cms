<?php
namespace App;
use App\Core\View;
use App\Models\Page;
use App\Core\Database;

class Menu{

    public function defaultAction(){

        $ModelsPage = new Page;
        $pages = $ModelsPage->getallPageActif();

        $view = new View("admin/menu", "back");
        $view->assign("title","Gestion Menu");
        $view->assign("pages",$pages);
        $view->assign("modelspage",$ModelsPage);



    }

    public function notifAction($message){
        $ModelsPage = new Page;
        $pages = $ModelsPage->getallPageActif();

        $view = new View("admin/menu", "back");
        $view->assign("title","Gestion Menu");
        $view->assign("pages",$pages);
        $view->assign("modelspage",$ModelsPage);
        $view->assign("erreur",$message);
    }

    public function addAction(){
        if(!empty($_POST['id'])){
            $ModelsPage = new Page;
            $max = $ModelsPage->maxmenu();
            $nb = $max['nb_menu'];
            if ($max[0]['nb_menu'] < 10){
                $ModelsPage->addmenu($_POST['id']);
                header("Location: /admin/menu");
                exit;
            }
            else{
                header('Location: /admin/menu?erreur=Vous ne pouvez dépasser de 10');
            }
            
        }
        else{
            header('Location: /admin/menu');
        }
    }

    public function removeAction(){
        if(!empty($_POST['id'])){
            $ModelsPage = new Page;
            $ModelsPage->removemenu($_POST['id']);
            header('Location: /admin/menu');
            exit;
        }
        else{
            header('Location: /admin/menu');
        }
    }

    public function addaccueilAction(){
        if(!empty($_POST['id'])){
            $ModelsPage = new Page;
            $ModelsPage->addaccueil($_POST['id']);
            header('Location: /admin/menu');
            exit;
        }
        else{
            header('Location: /admin/menu');
        }
    }
}

?>