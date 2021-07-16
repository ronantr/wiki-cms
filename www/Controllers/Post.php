<?php

namespace App;

use App\Models\Post as ModelPost;
use App\Models\User;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Models\Commentaire as ModelCommentaire;

class Post{

    public function defaultAction(){
        $Posts = new ModelPost;
        $allPosts = $Posts->getPosts();
        $view = new View("listepost", "back");
        $view->assign("allPosts", $allPosts);
        $view->assign("title","Admin Liste Post");
        echo "controller post action default";
        }

    public function postajouteAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("add-post", "back");
        $view->assign("title","Admin Création Post");
        $form = $Post->buildFormRegister();


        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Post->setPost_title($_POST["title"]);
                $Post->setPost_content($_POST["content"]);
                $Post->save();
                header('Location: \liste-post?message=2');
            }else{
                $view->assign("formErrors", $errors);
            }
        }
        $view->assign("form", $form);
        

    }
    public function posteditAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("edit-post", "back");
        $view->assign("title","Admin Edit Post");
        $view->assign("allPosts",$Post->getPosts());
        foreach($Post->getPosts() as $post){
            if($post["id"]==$_GET["id"]){
            
                $Post->setId($post["id"]);
                $Post->setPost_title($post["title"]);
                $Post->setPost_content($post["content"]);
            }
        }

        $form = $Post->buildFormEdit();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Post->setPost_title($_POST["title"]);
                $Post->setPost_content($_POST["content"]);
                $Post->save();
                header('Location: \liste-post?message=3');

            }else{
                $view->assign("formErrors", $errors);
            }
        }
        
        
    }
    public function postdeleteAction(){
        $id=$_GET['id'];
        $Post = new ModelPost();
        if (!empty($_GET['id'])) {
                $Post->deletePost($_GET['id']);
        }
        header('Location: \liste-post?message=1');
    }

    public function postAction(){
        $Post = new ModelPost;
        $allPosts = $Post->getPosts();
        $Commentaire = new ModelCommentaire;
        $allCommentaire = $Commentaire->getCommentaires();
        //print_r($allPosts);
        
        $view = new View("post", "back");
        $view->assign("allPosts", $allPosts);
        $view->assign("allCommentaire", $allCommentaire);
        $form = $Commentaire->buildFormRegister();   

        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Commentaire->setId($_GET["id"]);
                $Commentaire->setCommentaire_id_article($_POST["id_article"]);
                $Commentaire->setCommentaire_id_user($_POST["id_user"]);
                $Commentaire->setCommentaire_content($_POST["content"]);
                $Commentaire->save();
                $id = $_GET["id"];
            
               header('Location: \post?id='.$id.'&message=2');
            }else{
                $view->assign("formErrors", $errors);
            }
        }
        $view->assign("form", $form);

    }
}
