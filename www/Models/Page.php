<?php 
namespace App\Models;
use App\Core\Database;
class Page extends Database
{
	protected $id=null;
	protected $url;
	protected $slug;
	protected $content;
	protected $isMenu;
	protected $isAccueil;
	protected $status ;


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


	public function setUrl($url){
		$this->url = $url;
	}
	public function getUrl(){
		return $this->url;
	}
	public function setSlug($slug){
		$this->slug = $slug;
	}
	public function getSlug(){
		return $this->slug;
	}
	public function setStatus($status){
		$this->status = $status;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function setisMenu($menu){
		$this->isMenu = $menu;
	}

	public function setisAccueil($accueil){
		$this->isAccueil = $accueil;
	}
	
}
?>