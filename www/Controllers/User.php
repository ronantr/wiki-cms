<?php
namespace App;

use App\Core\Security as coreSecurity;
use App\Models\User as ModelsUser;
use App\Core\View;


class User{
    // private $users = array();

    // public function __construct(){
    //     $user = new Database();
    //     $table_users = $user->getUsers();
    //     foreach ($table_users as $oneuser){
            
    //         array_push($this->users,new User);
    //     }
        
    // }

    // public function getUsers(){;
    // return $users;
    // }
    public function defaultAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $users = new ModelsUser;
        $view = new View("admin/admin-users","back");
        $view->assign("users",$users->getUsers());
        $view->assign("title","Liste des utilisateur");
    }

    public function usereditAction(){
        if(!empty($_GET['id'])){
            $user_id = $_GET['id'];
            $user = new ModelsUser();
            if($user->isAdmin($_GET['id'])){
                if($user->lastAdmin()){
                    header('Location: /admin/users/liste-utilisateurs?message=4');
                    exit;
                }
            }
            $user_role = $_POST['role'];
            if (!empty($user_id)) {
                $user->setuserrole($user_id,$user_role);
            }
            header('Location: /admin/users/liste-utilisateurs?message=2');
        }
        else{
            header('Location: /admin/users/liste-utilisateurs');
        }
        
    }

    public function userdeleteAction(){
        if(!empty($_GET['id'])){
            $user = new ModelsUser();
            if($user->isAdmin($_GET['id'])){
                if($user->lastAdmin()){
                    header('Location: /admin/users/liste-utilisateurs?message=4');
                    exit;
                }
            }
            $user->CorbeilleUser($_GET['id']);
            header('Location: /admin/users/liste-utilisateurs?message=1');
        }
        else{
            header('Location: /admin/users/liste-utilisateurs');
        }
        

    }

    public function userdelete_definitelyAction(){
        $user_id = $_GET['id'];
        $user = new ModelsUser();
        if (!empty($user_id)) {
                $user->userdelete($user_id);
        }
        header('Location: /admin/users/liste-utilisateurs-deleted?message=1');

    }

    public function corbeilleAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $users = new ModelsUser;
        $view = new View("admin/admin-users-deleted","back");
        $view->assign("users",$users->getUsers());
        $view->assign("title","Utilisateur Supprimer");
    }

    public function userrestaurerAction(){
        $user_id = $_GET['id'];
        $user = new ModelsUser();
        if (!empty($user_id)) {
                $user->Restaurer($user_id);
        }
        header('Location: /admin/users/liste-utilisateurs?message=3');
    }
    public function userAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $user_username = $_SESSION['username'];
        if (!empty($user_username)) {
        $user = new ModelsUser();
        $view = new View("admin/admin-user","back");
        $view->assign("users",$user->getUsers());
        $view->assign("title","Mes Informations");
        
            
        }
    }
   
    public function valideruserAction(){
        $security = new coreSecurity(); 
		if(!$security->isConnected()){
			header('Location: /');
		}
        $id = $_GET['id'];
        $user = new ModelsUser();
        $user->validerUser($id);
        header('Location: /admin/users/liste-utilisateurs');
    }
    public function verifi_userAction(){
        $email = $_GET['email'];
        $token = $_GET['token'];
        $user = new ModelsUser();
        $valide=$user->VerifUserToken($token,$email);
        if (!empty($valide)){
            $user->setId($valide['id']);
            $user->setEmailVerified('1');
            $user->setToken(" ");
            $user->save();
            header('location: /');
        }
    }

    public function moncompteAction(){
        if($_SESSION['login']){
            $user = new ModelsUser;
            $view = new View("admin/admin-user","front");
            $view->assign("users",$user->getUsers());
            $view->assign("title","Mon Compte");
        }
        else{
            header('Location: /login ');
        }
    }

}

