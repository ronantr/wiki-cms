<?php
namespace App;

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
        $users = new ModelsUser;
        $view = new View("admin-users","back");
        $view->assign("users",$users->getUsers());
        $view->assign("title","Liste des utilisateur");
    }

    public function usereditAction(){
        $user_id = $_GET['id'];
        $user = new ModelsUser();
        $user_role = $_POST['role'];
        if (!empty($user_id)) {
            $user->setuserrole($user_id,$user_role);
        }
        header('Location: /admin/users/liste-utilisateurs?message=2');
    }

    public function userdeleteAction(){
        $user_id = $_GET['id'];
        $user = new ModelsUser();
        if (!empty($user_id)) {
                $user->CorbeilleUser($user_id);
        }
        header('Location: /admin/users/liste-utilisateurs?message=1');

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
        $users = new ModelsUser;
        $view = new View("admin-users-deleted","back");
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

}