<?php 
namespace App\Models;
use App\Core\Database;
class Page extends Database
{
	protected $id;
	protected $url;
	protected $slug;
	protected $status = 0;


    public function __construct(){
		parent::__construct();
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function setSlug($slug){
		$this->slug = $slug;
	}
	
}
?>