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
		
}
?>