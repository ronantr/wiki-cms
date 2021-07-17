<?php

namespace App\Core;

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
}