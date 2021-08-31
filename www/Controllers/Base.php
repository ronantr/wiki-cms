<?php

namespace App;

use App\Core\Security;
use App\Core\View;
use App\Core\Installer;
use App\Models\Page;


class Base{


	public function defaultAction(){

		//Je vais cherche en bdd le pseudo du user
		$pseudo = "Test";

		//Affiche moi la vue home;
		
		$page = new Page();
		$acceuil = $page->getpageaccueil();
		if(!empty($acceuil)){
			$view = new View("page", "front");
			$view->assign("page",$acceuil[0]);
			$articles = $page->getArticleByIdPage($acceuil[0]["id"]);
			$view->assign('articles',$articles);
			$view->assign("title",$acceuil[0]['slug']);
		}
		else{
			$view = new View();
			$view->assign("title","Votre site");
		}
		
		
		// $installer = new installer;
		// if(!$installer->checkInstall() xor file_exists('.env.prod')){
		// 	header('location: /installer');
		// }
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