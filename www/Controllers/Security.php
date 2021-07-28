<?php

namespace App;

use App\Core\Security as coreSecurity;
use App\Core\Database;
use App\Core\View;
use App\Core\Form;
use App\Models\User;
use App\Core\Mailer;


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
		$view->assign("title","Register");
		$form = $user->buildFormRegister();


		

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
            //var_dump($form);
            //print"<br>";
            //var_dump($_POST);
			if(empty($errors)){
                //$view->assign("formErrors", $errors);
				$user->setUsername($_POST["username"]);
				$user->setEmail(htmlspecialchars($_POST["email"]));
				$user->setPwd(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
				$user->save();
				header("Location: /login");
                //var_dump($user);
			}else{
				$view->assign("formErrors", $errors);
			}
		}
        $view->assign("form", $form);
	}

	public function loginAction(){
		$user = new User();
		$view = new View("login");
		$view->assign("title","Login");
		$form = $user->buildFormLogin();
		$erreur_affiche = false;

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
			if(isset($_POST["email"]) && isset($_POST["password"]))
			{
				$user->setEmail(htmlspecialchars($_POST["email"]));
				$email= htmlspecialchars($_POST["email"]);
				//$password = (password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
				$password = htmlspecialchars($_POST["password"]);
				if($email != "" && $password != "" && $user->getPwd($email,$password)){
					session_start();
					$_SESSION['username']= $user->getUsernamedb($email);
					$_SESSION['role'] = $user->getRoledb($email);
					$_SESSION['login']=true;
					// $view->assign("form", $form);
					echo $user->getRoledb($email);
					if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 ){
						header('Location: \admin\tableau-de-bord');
					}
					else{
						header('Location: \ ');
					}
				}
				else{
					$erreur_affiche = true;
				}
			}
		}
	$view->assign("form", $form);
	if($erreur_affiche){
		$view->assign("formErrors", $errors);
	}
	}

	public function logoutAction(){
		$_SESSION['login'] = false;
		header('Location: \ ');
	}
	public function recuperationmdpAction(){
        $user = new User();
		$view = new View("changement-mdp");
		$mailer = new Mailer();
		$form = $user->buildFormRecuperation();
		$view->assign("form", $form);
		if(!empty($_POST)){			
            $mail = $mailer->sendMail($_POST['email']);
			$errors = Form::validator($_POST, $form);
			if(empty($errors && $mail === true)){ 
    
					header('Location: \login');
				}else{
					header('Location: \recuperationmdp?message=1'); 
				}
			}
		}
	public function listofusersAction(){

		$security = new coreSecurity(); 
		if(!$security->isConnected()){
			die("Error not authorized");
		}

		echo "Là je liste tous les utilisateurs";
	}


}