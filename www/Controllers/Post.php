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
        $allCat = $Posts->getCategories();
        $view = new View("admin/listepost", "back");
        $view->assign("allPosts", $allPosts);
        $view->assign("categories",$allCat);
        $view->assign("title","Admin Liste Post");

        }

    public function postajouteAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("admin/add-post", "back");
        $view->assign("title","Admin Création Post");
        $form = $Post->buildFormRegister();


        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Post->setPost_title(htmlspecialchars($_POST["title"]));
                $Post->setPost_content(htmlspecialchars($_POST["content"]));
                $Post->save();
                header('Location: \admin\liste-post?message=2');
            }else{
                $view->assign("formErrors", $errors);
            }
        }
        $view->assign("form", $form);
        

    }
    public function posteditAction(){
        //Affiche moi la vue post;
        $Post = new ModelPost();
        $view = new View("admin/edit-post", "back");
        $view->assign("title","Admin Edit Post");
        $view->assign("allPosts",$Post->getPosts());
        foreach($Post->getPosts() as $post){
            if($post["id"]==$_GET["id"]){
            
                $Post->setId($post["id"]);
                $Post->setPost_title(htmlspecialchars($post["title"]));
                $Post->setPost_content(htmlspecialchars($post["content"]));
            }
        }

        $form = $Post->buildFormEdit();
        $view->assign("form", $form);

        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Post->setPost_title(htmlspecialchars($_POST["title"]));
                $Post->setPost_content(htmlspecialchars($_POST["content"]));
                $Post->save();
                header('Location: \admin\liste-post?message=3');

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
        header('Location: \admin\liste-post?message=1');
    }

    public function postAction(){
        $Post = new ModelPost;
        $allPosts = $Post->getPosts();
        $Commentaire = new ModelCommentaire;
        $allCommentaire = $Commentaire->getCommentaires();
        //print_r($allPosts);
        
        $view = new View("admin/post", "back");
        $view->assign("title","Post");
        $view->assign("allPosts", $allPosts);
        $view->assign("allCommentaire", $allCommentaire);
        $Commentaire->setCommentaire_id_article($_GET["id"]);
        $form = $Commentaire->buildFormCommentaire();   
        if(!empty($_POST)){
            $errors = Form::validator($_POST, $form);

            if(empty($errors)){
                $view->assign("formErrors", $errors);
                $Commentaire->setId($_GET["id"]);
                $Commentaire->setCommentaire_id_article($_POST["id_article"]);
                $Commentaire->setCommentaire_id_user($_POST["id_user"]);
                $Commentaire->setCommentaire_content(htmlspecialchars($_POST["content"]));
                $Commentaire->save();
                $id = $_GET["id"];
            
               //header('Location: \post?id='.$id.'&message=2');
            }else{
                $view->assign("formErrors", $errors);
            }
        }
        $view->assign("form", $form);

    }

    public function UpdatePostCatAction(){
        $id_acticle = $_GET['id'];
        $id_cat =$_POST['categorie'];
        if(!empty($id_cat)){
            $posts = new ModelPost;
            $posts->update_post_cat($id_acticle,$id_cat);
        }else{
            $posts = new ModelPost;
            $posts->update_post_cat($id_acticle,$id_cat = "NULL");
        }
        
        
        header('Location: /admin/liste-post');
    }

    public function publicpostAction(){
        $post = new ModelPost;
        $posts = $post->getPosts();
        $view = new View('public/liste-article','front');
        $view->assign('posts',$posts);
        $view->assign("title","Liste Acticle");
    }

    public function public_single_postAction(){
        $id_post = $_GET['id'];
        $posts = new ModelPost;
        $post = $posts->getpostbyid($id_post);
        $view = new View('public/single-post','front');
        $view->assign('post', $post);
        $view->assign("title",$post[0]['title']);
    }
}
