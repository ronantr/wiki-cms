<?php

namespace App;

use App\Core\Security;
use App\Core\View;



class Base{


	public function defaultAction(){

		//Je vais cherche en bdd le pseudo du user
		$pseudo = "Test";

		//Affiche moi la vue home;
		$view = new View();
		$view->assign("title","Votre site");
		$view->assign("pseudo", $pseudo);
		$view->assign("age", 21);
		$view->assign("genre", "h");

		//envoyer le pseudo à la vue
	}


	//Must be connected
	public function dashboardAction(){
		
		$security = new Security(); 
		if(!$security->isConnected()){
			die("Error not authorized");
		}


		//Affiche moi la vue dashboard;
		$view = new View("dashboard", "back");
		$view->assign("title","Dashboard Admin");
		
	}


}