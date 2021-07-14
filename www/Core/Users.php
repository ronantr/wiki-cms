<?php
namespace App\Core;

use App\Models\User;

class Users{

    private $users = array();

    public function __construct(){
        $user = new Database();
        $table_users = $user->getUsers();
        foreach ($table_users as $oneuser){
            array_push($this->users,new User($oneuser['id'],$oneuser['username'],$oneuser['password'],$oneuser['email'],$oneuser['role'],$oneuser['isDeleted'],$oneuser['emailVerified']));
        }
        
    }

    public function getUsers(){;
    return $users;
    }
}

?>