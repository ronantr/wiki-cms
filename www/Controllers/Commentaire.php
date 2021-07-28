<?php

namespace App;


use App\Models\Commentaire as ModelCommentaire;
use App\Core\Database;
use App\Models\Post;
use App\Core\View;
use App\Core\Form;

class Commentaire{

    public function defaultAction(){
        $Commentaire = new ModelCommentaire();
        $allCommentaire = $Commentaire->getCommentaires();
        $view = new View("admin/admin-listecommentaire", "back");
        $view->assign("allCommentaires", $allCommentaire);
        $view->assign("title","Admin Liste Commentaire");
        //echo "controller commentaire action default";
        }

    public function commentaireajouteAction(){
            //Affiche moi la vue post;
            $Commentaire = new ModelCommentaire();
            $view = new View("add-commentaire", "back");
            $view->assign("title","Admin Création Commentaire");
            $form = $Commentaire->buildFormCommentaire();
    
    
            if(!empty($_POST)){
                $errors = Form::validator($_POST, $form);
    
                if(empty($errors)){
                    $view->assign("formErrors", $errors);
                    $Commentaire->setCommentaire_content(htmlspecialchars($_POST["content"]));
                    $Commentaire->save();
                    header('Location: \liste-commentaire?message=2');
                }else{
                    $view->assign("formErrors", $errors);
                }
            }
            $view->assign("form", $form);
            
    
        }
        public function commentaireeditAction(){
            //Affiche moi la vue Commentaire;
            $Commentaire = new ModelCommentaire();
            $view = new View("edit-commentaire", "back");
            $view->assign("title","Admin Edit Commentaire");
            $view->assign("allCommentaires",$Commentaire->getCommentaires());
            foreach($Commentaire->getCommentaires() as $commentaire){
                if($commentaire["id"]==$_GET["id"]){
                
                    $Commentaire->setId($commentaire["id"]);
                    $Commentaire->setCommentaire_content(htmlspecialchars($commentaire["content"]));
                }
            }
    
            $form = $Commentaire->buildFormEdit();
            $view->assign("form", $form);
    
            if(!empty($_POST)){
                $errors = Form::validator($_POST, $form);
    
                if(empty($errors)){
                    $view->assign("formErrors", $errors);
                    $Commentaire->setCommentaire_content(htmlspecialchars($_POST["content"]));
                    $Commentaire->save();
                    header('Location: \admin\liste-commentaire?message=3');
    
                }else{
                    $view->assign("formErrors", $errors);
                }
            }
            
            
        }
        public function commentairedeleteAction(){
            $id=$_GET['id'];
            $Commentaire = new ModelCommentaire();
            if (!empty($_GET['id'])) {
                    $Commentaire->deleteCommentaire($_GET['id']);
            }
            header('Location: \admin\liste-commentaire?message=1');
        }
    
        public function commentaireAction(){
            $Commentaire = new ModelCommentaire;
            $allCommentaires = $Commentaire->getCommentaires();
            //print_r($allPosts);
            
                $view = new View("post", "back");
                $view->assign("allCommentaires", $allCommentaires);
            
        }

}