<?php
namespace App\Models;
use App\Core\Database;
class Page_categorie extends Database
{
    protected $id=null;
    protected $id_page;
    protected $id_categorie;

    public function __construct(){
		parent::__construct();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getid_page(){
        return $this->id_page;
    }

    public function setid_page($id){
        $this->id_page = $id;
    }

    public function getid_categorie(){
        return $this->id_categorie;
    }

    public function setid_categorie($id){
        $this->id_categorie = $id;
    }
    
    
}



?>