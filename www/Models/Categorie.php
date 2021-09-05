<?php 
namespace App\Models;
use App\Core\Database;

class Categorie extends Database
{
	private $id=null;
	protected $name;

    public function __construct(){
		parent::__construct();
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setname($name){
		$this->name = $name;
	}

	public function getname(){
		return $this->name;
	}

	public function buildFormcategorieadd(){
		return[
			"config"=>[
				"method"=>"POST",
				"Action"=>"/admin/add-categorie",
				"Submit"=>"Modifier",
				"class"=>"cat_form"
			],
			"input"=>[

				"name"=>[
								"type"=>"input",
								"class"=>"",
								"lengthMax"=>"25",
								"lengthMin"=>"2",
								"error"=>"Votre Contenue doit faire entre 2 et 25 caractères",
								"placeholder"=>$this->getname(),
								"defaultValue"=>$this->getname()
				],
			]
		];
	}

	public function buildFormcategorie(){
		return[
			"config"=>[
				"method"=>"POST",
				"Action"=>"",
				"Submit"=>"Modifier",
				"class"=>"cat_form"
			],
			"input"=>[

				"name"=>[
								"type"=>"input",
								"class"=>"",
								"lengthMax"=>"25",
								"lengthMin"=>"2",
								"error"=>"Votre Contenue doit faire entre 2 et 25 caractères",
								"placeholder"=>$this->getname(),
								"defaultValue"=>$this->getname()
				],
			]
		];
	}
		
}
?>