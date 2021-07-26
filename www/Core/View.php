<?php

namespace App\Core;

use App\Core\Form;

class View
{
	// front_tpl.php
	private $template; // front ou back
	// default_view.php
	private $view; // default, dashboard, profile, ....
	private $data = [];

	public function __construct($view="default", $template="front"){
		$this->setTemplate($template);
		$this->setView($view);
		
	}

	public function setTemplate($template){
		if(file_exists("Views/Templates/".$template."_tpl.php")){
			$this->template = "Views/Templates/".$template."_tpl.php";
		}else{
			die("Le template n'existe pas");
		}
	}

	public function setView($view){
		if(file_exists("Views/".$view."_view.php")){
			$this->view = "Views/".$view."_view.php";
		}else{
			die("La vue n'existe pas");
		}
	}

	public function assign($key, $value){
		$this->data[$key] = $value;
	}

	public static function lookupfile(string $file){
		$filename = explode(".", trim($file));
		$extension = array_pop($filename);

		switch ($extension){
			case "css" :
				return '/public/css/'.$file;
				break;
			case "js" :
				return '/public/js/'.$file;
				break;
			case "png" || "jpg" || "jpeg" || "svg":
				return '/public/images/'.$file;
				break;
			case "sql":
				return '/public/sql/'.$file;
				break;
			default:
				echo "Fichier Non Trouvé";
				break;
		}
	}



	public function __destruct(){
		// $this->data = ["pseudo"=>"Prof"];  ----> $pseudo = "Prof";
		extract($this->data);
		include $this->template;
	}


}




