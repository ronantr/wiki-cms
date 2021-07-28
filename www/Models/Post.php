<?php 
namespace App\Models;

use App\Core\Database;
use App\Core\Form;


class Post extends Database
{
	private $id=null;
	protected $title;
	protected $content;
	protected $id_categorie;

	public function __construct(){
		parent::__construct();
	}
	
    /**
    * @param $id
    */
	public function setId($id){
		//Il va chercher en BDD toutes les informations de l'utilisateur
		//et il va alimenter l'objet avec toutes ces données
		$this->id = $id;
	}
	
    /**
    * @return mixed
    */
	public function getId(){
		return $this->id;
	}


    /**
    * @param $title
    */
	public function setPost_title($title){
		$this->title = $title;
	}
	/**
    * @return mixed
    */
    public function getTitle()
    {
        return $this->title;
    }

    /**
    * @param $content
    */

	public function setPost_content($content){
		$this->content = $content;
	}

	/**
    * @return mixed
    */

    public function getContent()
    {
        return $this->content;
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
					"id"=>[
                        "type"=>"hidden",
                        "required"=>true,
                        "defaultValue"=>$this->getId()
                    ],
					"title"=>[
									"type"=>"text",
									"class"=>"form_input",
									"label"=>"titre :",
									"lengthMax"=>"120",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre Titre doit faire entre 2 et 120 caractères",
									"placeholder"=>"Titre",
									"defaultValue"=>$this->getTitle()
									],
					"content"=>[
									"type"=>"mytextarea",
									"lengthMax"=>"32500",
									"lengthMin"=>"2",
									"label"=>"content :",
									"error"=>"Votre Contenue doit faire entre 2 et 32500 caractères",
									"placeholder"=>"Contenue",
									"defaultValue"=>$this->getContent()
									]
						]
				];
	}
	public function buildFormEdit(){ 
		return [

				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"Post",
					"class"=>"form_register"
				],
				"input"=>[
					"id"=>[
                        "type"=>"hidden",
                        "required"=>true,
                        "defaultValue"=>$this->getId()
                    ],
					"title"=>[
									"type"=>"text",
									"class"=>"form_input",
									"label"=>"titre :",
									"lengthMax"=>"120",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre Titre doit faire entre 2 et 120 caractères",
									"placeholder"=>"Titre",
									"defaultValue"=>$this->getTitle()
									],
					"content"=>[
									"type"=>"mytextarea",
									"lengthMax"=>"32500",
									"lengthMin"=>"2",
									"label"=>"content :",
									"error"=>"Votre Contenue doit faire entre 2 et 32500 caractères",
									"placeholder"=>"Contenue",
									"defaultValue"=>$this->getContent()
									]
						]
				];
	}

}

