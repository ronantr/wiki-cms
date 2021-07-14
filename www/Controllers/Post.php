<?php

namespace App;

use App\Models\Post as ModelPost;
use App\Models\User;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;

class Post{

    public function defaultAction(){
        $Posts = new ModelPost;
        $allPosts = $Posts->getPosts();
        $view = new View("listepost", "back");
        $view->assign("allPosts", $allPosts);
       //echo "controller post action default";
        }

    public function postajouteAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("add-post", "back");
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
        $view->assign("allPosts",$Post->getPosts());
        if(!empty($_POST)){
            if($_POST['id'] != ''){
                $Post->setId($_POST['id']);
            }
        }

        $form = $Post->buildFormRegister();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Post->setPost_title($_POST["title"]);
                $Post->setPost_content($_POST["content"]);
                $Post->save();

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
        //print_r($allPosts);
        
            $view = new View("post", "back");
            $view->assign("allPosts", $allPosts);
        
    }
}
