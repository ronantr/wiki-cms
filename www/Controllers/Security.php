<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Core\ConstantManager;
use App\Models\User;
use App\Models\Post;

class Security{


	public function defaultAction(){
		echo "controller security action default";
	}


	public function registerAction(){
		
		
/*
		$user = new User();
		$user->setId(3);
		$user->setUsername("Tutu");
        $user->setEmail("toto@gmail.com");
        $user->setPwd("Test1234");
		 /*
			[id:App\Models\User:private] => 3 
			[username:protected] => Toto
			[email:protected] => y.skrzypczyk@gmail.com
			[pwd:protected] => Test1234

		$user->save();*/

		$user = new User();
		$view = new View("register");
		$form = $user->buildFormRegister();


		

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
            //var_dump($form);
            //print"<br>";
            //var_dump($_POST);
			if(empty($errors)){
                //$view->assign("formErrors", $errors);
				$user->setUsername($_POST["username"]);
				$user->setEmail($_POST["email"]);
				$user->setPwd($_POST["password"]);
				$user->save();
                var_dump($user);
			}else{
				$view->assign("formErrors", $errors);
			}
		}
        $view->assign("form", $form);
	}

	public function loginAction(){
		$user = new User();
		$view = new View();
		$form = $user->buildFormLogin();
		$view->assign("form", $form);
		session_start();
	    echo "controller security action login";

	}

	public function logoutAction(){
		echo "controller security action logout";
	}

	public function listofusersAction(){

		$security = new coreSecurity(); 
		if(!$security->isConnected()){
			die("Error not authorized");
		}

		echo "Là je liste tous les utilisateurs";
	}
	public function postAction(){
		//Affiche moi la vue post;
		$post = new Post();
		$view = new View("post", "back");
		$form = $post->buildFormRegister();
		$view->assign("form", $form);

		

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
		}
		if(empty($errors)){
                $view->assign("formErrors", $errors);
				$post->setPost_title("Test");
				$post->setPost_content("Test du content");
				$post->save();

			}else{
				$view->assign("formErrors", $errors);
			}
	}

}