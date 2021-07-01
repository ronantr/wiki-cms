<?php 
namespace App\Models;

use App\Core\Database;

class Post extends Database
{
	private $id=null;
	protected $title;
	protected $content;

	public function __construct(){
		parent::__construct();
	}
		public function setId($id){
		//Il va chercher en BDD toutes les informations de l'utilisateur
		//et il va alimenter l'objet avec toutes ces données
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
	public function setPost_title($title){
		$this->title = $title;
	}
	public function setPost_content($content){
		$this->content = $content;
	}

	public function buildFormRegister(){
		return [

				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"Post",
					"class"=>"form_register"
				],
				"input"=>[
					"title"=>[
									"type"=>"text",
									"class"=>"form_input",
									"label"=>"titre",
									"lengthMax"=>"120",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre Titre doit faire entre 2 et 120 caractères",
									"placeholder"=>"Titre"
									],
					"content"=>[
									"type"=>"mytextarea",
									"lengthMax"=>"32500",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre Contenue doit faire entre 2 et 32500 caractères",
									"placeholder"=>"Contenue"
									]
						]
				];
	}

}

