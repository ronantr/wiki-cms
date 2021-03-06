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
		$view->assign("form", $form);

		

		if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
            //var_dump($form);
            //print"<br>";
			//var_dump($_POST);
			if($_POST["password"] != $_POST["pwdConfirm"]){
				$errors[1]="Confirmer Votre mdp";
			}
			if($user->existebd($_POST["email"],"editor","email") == true){
				$errors[0]="Mail exit";
			}
			if(empty($errors)){
				//$view->assign("formErrors", $errors);
			
				$user->setUsername($_POST["username"]);
				$user->setEmail(htmlspecialchars($_POST["email"]));
				$user->setPwd(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
				$user->setRole(2);
				$user->setIsDeleted(0);
				$user->setEmailVerified(0);
				$user->save();
				header("Location: /login");
				//var_dump($user);
			
				
			}else{
				$view->assign("formErrors", $errors);
			}
			
			
		}
        
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
					$_SESSION['email'] = $email;
					$_SESSION['username']= $user->getUsernamedb($email);
					$_SESSION['role'] = $user->getRoledb($email);
					$_SESSION['login']=true;
					// $view->assign("form", $form);
					
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
		$_SESSION['email'] = "";
		$_SESSION['role'] ="";
		$_SESSION['username']="";
		$_SESSION['login'] = false;
		header('Location: \ ');
	}
	public function recuperationmdpAction(){
        $user = new User();
		$view = new View("changement-mdp");
		$mailer = new Mailer();
		$form = $user->buildFormResetPasswordEmail();
		$view->assign("form", $form);
		if(!empty($_POST)){			
            $mail = $mailer->sendMailForgetPassword($_POST['email'],$_POST['tokenemail']);
			$errors = Form::validator($_POST, $form);
			if(empty($errors && $mail === true)){ 
    
					header('Location: \login');
				}else{
					header('Location: \recuperationmdp?message=1'); 
				}
			}
		}
	public function mailVerifAction(){
		$mailer = new Mailer();
		$token = $_SESSION["csrf"];
		$email = $_SESSION["email"];
		$mailer->sendMailVerif($email,$token);
	}
	public function changemdpAction(){
		$user = new User();
        $email = $_GET['email'];
        $token = $_GET['token'];
		$view = new View("modif-mdp");
        $valide=$user->VerifUserToken($token,$email);
        $form = $user->buildFormResetPassword();
		$view->assign("form", $form);
        if(!empty($_POST)){
			$errors = Form::validator($_POST, $form);
			if($_POST["password"] != $_POST["pwdConfirm"]){
				$errors[1]="Confirmer Votre mdp";
			}
			if(empty($errors)){
				$user->setId($valide['id']);
				$user->setToken(" ");
				$user->setPwd(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
				$user->save();
				//echo $valide;
				header("Location: /login");
			}else{
				$view->assign("formErrors", $errors);
			}
		}		
	}
	public function listofusersAction(){

		$security = new coreSecurity(); 
		if(!$security->isConnected()){
			die("Error not authorized");
		}

		echo "L?? je liste tous les utilisateurs";
	}


}