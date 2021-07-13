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
        echo "controller post action default";
        }

    public function postAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("post", "back");
        $form = $Post->buildFormRegister();


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
        $view->assign("form", $form);
    }
}
