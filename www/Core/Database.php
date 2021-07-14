<?php

namespace App\Core;


class Database
{

	private $pdo;
	private $table;

	public function __construct(){
		try{
            $this->pdo = new \PDO(DBDRIVER.":dbname=".DBNAME.";host=".DBHOST.";port=".DBPORT, DBUSER, DBPWD);

			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    		$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

		}catch(Exception $e){
			die ("Erreur SQL ".$e->getMessage());
		}

		//echo get_called_class(); //  App\Models\User ici on peut récupérer le nom de la table
		$classExploded = explode("\\", get_called_class());
		$this->table = DBPREFIX.end($classExploded);
	}

	public function save(){

		/*//INSERT ou un UPDATE

		
		// Array ([firstname] => Yves [lastname] => Skrzypczyk [email] => y.skrzypczyk@gmail.com [pwd] => Test1234 [country] => fr [status] => 0 [role] => 0 [isDeleted] => 0 [pdo] => PDO Object ( ) [table] => )
		//print_r(get_object_vars($this));
		
		//Array ( [pdo] => [table] => )
		//print_r(get_class_vars(get_class()));

		//Créer une requête SQL Dynamique en fonction de la class enfant
		//Pour faire un insert ou un update.
		//Si l'objet a un ID il s'agit d'un update

		//Array ( [firstname] => Yves [lastname] => Skrzypczyk [email] => y.skrzypczyk@gmail.com [pwd] => Test1234 [country] => fr [status] => 0 [role] => 0 [isDeleted] => 0 )*/


		$data = array_diff_key (
					get_object_vars($this),
					get_class_vars(get_class())
				);
        $columns = array_keys($data);
        //var_dump($data);
        switch($columns[0]){
            case 'username':
                $this->table = DBPREFIX."editor";
                break;
            case 'title':
                $this->table = DBPREFIX."article";
                break;
        }
		if(is_null($this->getId())){
			//INSERT

            //var_dump(array_keys($data));

            $query = $this->pdo->prepare("INSERT INTO ".$this->table." (
                                            ".implode(",", $columns)."
                                            ) VALUES (:".implode(",:", $columns).");");
            echo '<br><br><br>';
            //var_dump($query);
            $query->execute($data);
		}else{            
			foreach ($data as $key => $value) {
			if (!is_null($value)) {
				$Update[] = $key . "=:" . $key;
			}
		}

		$sql = "UPDATE " . $this->table . " SET " . implode(",", $Update) . " WHERE id=" . $this->getId();
		$query = $this->pdo->prepare($sql);

		foreach ($data as $key => $value) {
			if (!is_null($value)) {
				$query->bindValue(":$key", $value);
			}

		}
	   $query->execute();
		}



		if(is_null($this->getId()))
			$this->setId($this->pdo->lastInsertId()) ;
		echo $this->getId();
		$_SESSION['id'] = $this->pdo->lastInsertId();

	}
    public function getPwd($email,$pwd){
		$this->table = DBPREFIX."editor";
        $query = $this->pdo->prepare("SELECT password FROM $this->table WHERE email = '$email';");
        $query-> execute();
        $password = $query-> fetch(\PDO::FETCH_ASSOC);
		$password = $password['password'];
        if(password_verify($pwd, $password)){
            return true;
        }else{
            return false;
        }
	}
	public function getUsername($email){
        $this->table = DBPREFIX."editor";
	    $query = $this->pdo->prepare("SELECT username FROM $this->table WHERE email = '$email';");
	    $query->execute();
	    $result = $query->fetch(\PDO::FETCH_ASSOC);
	    return $result['username'];
    }
    public function getPosts(){
        $this->table = DBPREFIX."article";
        $query = $this->pdo->prepare("SELECT * FROM ".$this->table." ; ");
        $query->execute();
        $posts = $query->fetchall();
        return $posts;
    }
	public function deletePost($id){
		$this->table = DBPREFIX."article";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = '$id';");
		$query->execute();
		
	}

}
