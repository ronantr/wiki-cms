<?php

namespace App\Core;
use App\Models\Page;
use App\Core\Installer;

class Routing{

	public $routesPath = "routes.yml";
	public $controller="Base";
	public $action="default";
	public $routes = [];
	public $slugs = [];
	public $controllerPage="Page";
	public $actionPage="mainAction";


	public function __construct($uri){
		//Faut vérifier que le fichier existe
		$this->routes = yaml_parse_file($this->routesPath);
		//Faut vérifier qu'il y a un controller pour cette route
		if(!empty($this->routes[$uri])){
			$this->setController($this->routes[$uri]["controller"]);
			$this->setAction($this->routes[$uri]["action"]);
		}


		foreach ($this->routes as $slug=>$info) {
			$this->slugs[$info["controller"]][$info["action"]] = $slug;
		}

	}


	//PascalCase pour une class
	public function setController($controller){
		$this->controller=ucfirst(mb_strtolower($controller));
	}

	public function setAction($action){
		$this->action=$action."Action";
	}

	public function getController(){
		return $this->controller;
	}

	public function getControllerPage(){
		return $this->controllerPage;
	}

	public function getAction(){
		return $this->action;
	}

	public function getActionPage(){
		return $this->actionPage;
	}
    public function redirectToInstaller() {
        header('location: /installer');
        exit(0);
    }
	public function getControllerWithNamespace(){
		return APP_NAMESPACE.$this->controller;
	}

	public function getControllerWithNamespacePage(){
		return APP_NAMESPACE.$this->controllerPage;
	}

    public static function getListOfRoutes() {
        return yaml_parse_file($this->routesPath);
    }

	/*
		/list-des-utilisateurs:
	  	controller: Security
	  	action: listofusers
	 */
	public function getUri($controller, $action){

		if(!empty($this->slugs[$controller]) && !empty($this->slugs[$controller][$action]))
			return $this->slugs[$controller][$action];


		die("Aucun route ne correspond à ".$controller." -> ".$action );
	}

	public function dbexiste($uri){
		$page = new Page;
		$uris = $page->getUris();
		foreach ($uris as $url){
			$uricredi = "/".$url['url'];
			if ($uri == $uricredi){
				return true;
			}
		}
	}
	public function getBaseUrl() {
	return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
}

    static function writeUrlSitemap($loca) {
        return '<url>
                    <loc>'.$loca.'</loc>
                    <lastmod>'.date('c',time()).'</lastmod>
                </url>';
    }


    static function getBaseRouteSitemap($routes, $routes_exclude): string
    {
        $sitemap = "";

        foreach ($routes as $key => $route) {
            if(!in_array($key, $routes_exclude) && !strpos($key, 'admin')) {
                $loca = self::getBaseUrl() . $key;
                $sitemap .= self::writeUrlSitemap($loca);
            }
        }
        return $sitemap;
    }
    static function getDynamicSitemap(): string
    {
        $sitemap = "";

        $post = new \App\Models\Post();
        $page = new \App\Models\Page();
		$all_postes = $post->getPosts();
        $all_pages = $page->getallpage();

        foreach($all_postes as $post) {
            $loc = self::getBaseUrl() . $post['url'];
            $sitemap .= self::writeUrlSitemap($loc);
        }
        foreach($all_pages as $page) {
            $loc = self::getBaseUrl() . $page['url'];
            $sitemap .= self::writeUrlSitemap($loc);
        }
        return $sitemap;
    }
}
/*
if(file_exists("routes.yml")){

	$listOfRoutes = yaml_parse_file("routes.yml");

	echo "<pre>";
	print_r($listOfRoutes);




	if(!empty($listOfRoutes[$uri]) 
		&& !empty($listOfRoutes[$uri]["controller"]) 
		&& !empty($listOfRoutes[$uri]["action"])){
		

		$c = $listOfRoutes[$uri]["controller"]."Controller";
		$a = $listOfRoutes[$uri]["action"]."Action";

		//Est-ce que j'ai les droits, si ce n'est pas le cas erreur access denied : 403

	}else{
		die("Erreur 404");
	}

}else{
	die("Le fichier de routing n'existe pas");
}
*/