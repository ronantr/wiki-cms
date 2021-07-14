<?php
namespace App;
use App\Core\Users;
use App\Core\View;

class User{

    public function defaultAction(){
        $users = new Users;
        $view = new View("admin-users","back");
        $view->assign("users",$users->getUsers());
    }
}