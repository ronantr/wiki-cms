<?php 
namespace App\Models;

use App\Core\Database;
use App\Core\Form;


class Commentaire extends Database
{
	private $id=null;
	protected $content;
    protected $id_article;
    protected $id_user;

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
    * @param $content
    */

	public function setCommentaire_content($content){
		$this->content = $content;
	}

	/**
    * @return mixed
    */

    public function getContent()
    {
        return $this->content;
    }

    /**
    * @param $id_article
    */

	public function setCommentaire_id_article($id_article){
		$this->id_article = $id_article;
	}
    /**
    * @return mixed
    */

    public function getId_article()
    {
        return $this->id_article;
    }

    /**
    * @param $id_article
    */

	public function setCommentaire_id_user($id_user){
		$this->id_user = $id_user;
	}

	/**
    * @return mixed
    */

    public function getId_user()
    {
        return $this->id_user;
    }    

    public function buildFormRegister(){ 
		return [

				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"commenter",
					"class"=>"form_register"
				],
				"input"=>[

					"content"=>[
									"type"=>"mytextarea",
									"lengthMax"=>"32500",
									"lengthMin"=>"2",
									"label"=>"content :",
									"error"=>"Votre Contenue doit faire entre 2 et 32500 caractères",
									"placeholder"=>"Contenue",
									"defaultValue"=>$this->getContent()
                    ],
                    "id_article"=>[
                        "type"=>"hidden",
                        "required"=>true,
                        "defaultValue"=>$this->getId_article()
                    ],
                    "id_user"=>[
                        "type"=>"hidden",
                        "required"=>true,
                        "defaultValue"=>"1"
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