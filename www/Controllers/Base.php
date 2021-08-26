<?php

namespace App;

use App\Core\Security;
use App\Core\View;
use App\Core\Installer;


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
		$installer = new installer;
		if(!$installer->checkInstall() xor file_exists('.env.prod')){
			header('location: /installer');
		}
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

	public function sitemapAction() {
        header('Content-Type: text/xml; charset=UTF-8');
        $routes = Routing::getListOfRoutes();
        // $routes_exclude = [
        //     "/sitemap.xml",
        //     "/resgister",
        //     "/s-inscrire",
        //     "/login",
        //     "/logout",
        //     "/recuperationmdp",
        //     "/liste-des-utilisateurs",
        //     "/installer",
        //     "/make-install"
        // ];
        $sitemap = "";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $sitemap .= Routing::getBaseRouteSitemap($routes, $routes_exclude);
        $sitemap .= Routing::getDynamicSitemap();
        $sitemap .= '</urlset>';

        echo $sitemap;
	}
}