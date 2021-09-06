<?php

namespace App\Core;
use App\Models\User;

class Security
{
	

	public static function isConnected(){
		if (empty($_SESSION['login'])){
			$_SESSION['login'] = false;
		}
		return $_SESSION['login'];
	}

	public function isAutorized($uriex){
		if($uriex[1] == "admin"){
			if($_SESSION['role'] == 1 || $_SESSION['role'] == 3 ){
				if($uriex['2'] == "users" || $uriex['2'] == "menu" || $uriex['2'] == "theme" ){
					if($_SESSION['role'] == 3){
						header('Location: /admin/tableau-de-bord');
					}
				}
			}
			else{
				header('Location: / ');
			}
		}
	}

	public function isAdmin(){
		if(!empty($_SESSION['role'])){
			if($_SESSION['role'] == 1){
				return true;
			}
			else { return false;}
		}
	}

	public function verifAccount(){
		if(!empty($_SESSION['login'])){
			if($_SESSION['login'] == true){
				$user  = new User; 
				$userselect = $user->getuserbyemail($_SESSION['email']);
				if(empty($userselect)){
					header('Location: /logout ');
				}

			}
			
		}
		
	}
}