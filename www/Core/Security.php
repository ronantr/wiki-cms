<?php

namespace App\Core;
use App\Models\User;

class Security
{
	

	public function isConnected(){
		if (empty($_SESSION['login'])){
			$_SESSION['login'] = false;
		}
		return $_SESSION['login'];
	}

	public function isAutorized($uriex){
		if($uriex[1] == "admin"){
			if($_SESSION['role'] == 1 || $_SESSION['role'] == 3 ){
				if($uriex['2'] == "users"){
					if($_SESSION['role'] == 3){
						header('Location: /admin/tableau-de-board');
					}
				}
			}
			else{
				header('Location: / ');
			}
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