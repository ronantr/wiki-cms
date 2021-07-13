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

 
}