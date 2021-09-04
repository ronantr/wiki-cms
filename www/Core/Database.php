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

		/*INSERT ou un UPDATE
		Array ([firstname] => Yves [lastname] => Skrzypczyk [email] => y.skrzypczyk@gmail.com [pwd] => Test1234 [country] => fr [status] => 0 [role] => 0 [isDeleted] => 0 [pdo] => PDO Object ( ) [table] => )
		print_r(get_object_vars($this));
		
		Array ( [pdo] => [table] => )
		print_r(get_class_vars(get_class()));

		Créer une requête SQL Dynamique en fonction de la class enfant
		Pour faire un insert ou un update.
		Si l'objet a un ID il s'agit d'un update

		Array ( [firstname] => Yves [lastname] => Skrzypczyk [email] => y.skrzypczyk@gmail.com [pwd] => Test1234 [country] => fr [status] => 0 [role] => 0 [isDeleted] => 0 )*/


		$data = array_diff_key (
					get_object_vars($this),
					get_class_vars(get_class())
				);
        $columns = array_keys($data);
        //var_dump($data);
		//var_dump($columns);
        switch($columns[0]){
            case 'username':
                $this->table = DBPREFIX."editor";
                break;
            case 'title':
                $this->table = DBPREFIX."article";
                break;
			case 'content':
				$this->table = DBPREFIX."commentaire";
				break;
        }


		if ($this->table == DBPREFIX."commentaire"){
			$query = $this->pdo->prepare("INSERT INTO ".$this->table." (
				".implode(",", $columns)."
				) VALUES (:".implode(",:", $columns).");");
				//echo '<br><br><br>';
				//var_dump($query);
				$query->execute($data);
		}elseif(is_null($this->getId())){
			//INSERT

			
            $query = $this->pdo->prepare("INSERT INTO ".$this->table." (
                                            ".implode(",", $columns)."
                                            ) VALUES (:".implode(",:", $columns).");");
            //echo '<br><br><br>';
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
		//print_r($query);
		foreach ($data as $key => $value) {
			if (!is_null($value)) {
				$query->bindValue(":$key", $value);
			}

		}
	   $query->execute();
	   
		}



		if(is_null($this->getId()))
			$this->setId($this->pdo->lastInsertId()) ;
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
	public function getUsernamedb($email){
        $this->table = DBPREFIX."editor";
	    $query = $this->pdo->prepare("SELECT username FROM $this->table WHERE email = '$email';");
	    $query->execute();
	    $result = $query->fetch(\PDO::FETCH_ASSOC);
	    return $result['username'];
	}

	public function getRoledb($email){
        $this->table = DBPREFIX."editor";
	    $query = $this->pdo->prepare("SELECT role FROM $this->table WHERE email = '$email';");
	    $query->execute();
	    $result = $query->fetch(\PDO::FETCH_ASSOC);
	    return $result['role'];
	}

	public function getuserbyemail($email){
		$this->table = DBPREFIX."editor";
	    $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = '$email';");
	    $query->execute();
	    $result = $query->fetch(\PDO::FETCH_ASSOC);
	    return $result;
	}
	

    public function getPosts(){
        $this->table = DBPREFIX."article";
        $query = $this->pdo->prepare("SELECT * FROM ".$this->table." ; ");
        $query->execute();
        $posts = $query->fetchall();
        return $posts;
	}
	public function getpostbyid($id){
		$this->table = DBPREFIX."article";
        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id =$id and status = 1 and isDeleted = 0; ");
        $query->execute();
        $posts = $query->fetchall();
        return $posts;
	}
	public function deletePost($id){
		$this->table = DBPREFIX."article";
		$commentaires = DBPREFIX."commentaire";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = '$id';");
		$query->execute();
		$query = $this->pdo->prepare("DELETE FROM $commentaires WHERE id_article = '$id';");
		$query->execute();
	}

	public function getCommentaires(){
		$this->table = DBPREFIX."commentaire";
	    $query = $this->pdo->prepare("SELECT * FROM ".$this->table." ; ");
        $query->execute();
        $commentaires = $query->fetchall();
        return $commentaires;
	}

	public function getCommentairesuser($id_article){
		$this->table = DBPREFIX."commentaire";
		$user = DBPREFIX."editor";
	    $query = $this->pdo->prepare("SELECT comment.id, comment.createdAt , comment.content, u.username  FROM $this->table as comment, $user as u where u.id = comment.id_user and comment.id_article = $id_article order by comment.createdAt  ; ");
        $query->execute();
        $commentaires = $query->fetchall();
        return $commentaires;
	}
	
	public function deleteCommentaire($id){
		$this->table = DBPREFIX."commentaire";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = '$id';");
		$query->execute();
	}

	public function getUsers(){
		$table = DBPREFIX."editor";
        $query = $this->pdo->prepare("SELECT * FROM $table ; ");
        $query->execute();
        $users = $query->fetchall();
        return $users;
	}

	public function validerUser($id){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET emailVerified = 1 WHERE id =$id; ");
		$query->execute();
	}

	public function userdelete($id){
		$this->table = DBPREFIX."editor";
		$commentaires= DBPREFIX."commentaire";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = '$id';");
		$query->execute();
		$query = $this->pdo->prepare("DELETE FROM $commentaires WHERE id_user = '$id';");
		$query->execute();
	}

	public function CorbeilleUser($id){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET isDeleted = 1 WHERE id = '$id';");
		$query->execute();

	}
	public function VerifUser($email){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET emailVerified = 1 WHERE email = '$email';");
		$query->execute();
	}
	public function VerifUserToken($token,$email){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("SELECT email FROM $table WHERE tokenemail = '$token' AND email = '$email';");
	}
	public function CreateUserToken($token,$email){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET tokenemail = '$token' WHERE email = '$email';");
		$query->execute();
	}
	public function ModificationUser($email,$password){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET password = '$password' WHERE email = '$email';");
		$query->execute();
	}
	public function restaurer($id){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET isDeleted = 0 WHERE id = '$id';");
		$query->execute();
	}

	public function setuserrole($id,$role){
		$this->table = DBPREFIX."editor";
		$query = $this->pdo->prepare("UPDATE $this->table SET role = $role WHERE id = '$id';");
		$query->execute();
	}


	public function getCategories(){
		$this->table = DBPREFIX."categorie";
		$query = $this->pdo->prepare("SELECT * FROM $this->table ; ");
		$query->execute();
        $categories = $query->fetchall();
        return $categories;
	}
	
	public function createDatabase($query) {
        
        $query = $this->pdo->exec($query);
        return true;
	}
	
	public function renameDatabase(){
		$DBPREFIX = DBPREFIX;
		$DBPREFIX_article = $DBPREFIX."article";
		$DBPREFIX_categorie = $DBPREFIX."categorie";
		$DBPREFIX_commentaire = $DBPREFIX."commentaire";
		$DBPREFIX_editor = $DBPREFIX."editor";
		$DBPREFIX_static = $DBPREFIX."static";
		$DBPREFIX_page_categorie = $DBPREFIX."page_categorie";
		$DBPREFIX_page = $DBPREFIX."page";
		$query = $this->pdo->prepare("alter table article rename  TO $DBPREFIX_article ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table commentaire rename  TO $DBPREFIX_commentaire ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table editor rename  TO $DBPREFIX_editor ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table categorie rename  TO $DBPREFIX_categorie ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table page_categorie rename  TO $DBPREFIX_page_categorie ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table static rename  TO $DBPREFIX_static ;");
		$query->execute();
		$query = $this->pdo->prepare("alter table page rename  TO $DBPREFIX_page ;");
		$query->execute();
		return true;

	}

	public function update_post_cat($id_post,$id_cat){
		$this->table = DBPREFIX."article";
		$query = $this->pdo->prepare("UPDATE $this->table SET id_categorie = $id_cat WHERE id = $id_post;");
		
		$query->execute();
	}

	public function getUris(){
		$this->table = DBPREFIX."page";
		$query = $this->pdo->prepare("SELECT * FROM $this->table ; ");
		$query->execute();
        $pages = $query->fetchall();
        return $pages;
	}

	public function savePages($url,$slug,$content,$status){
		$this->table = DBPREFIX."page";
		$query = $this->pdo->prepare("INSERT INTO $this->table (url,slug,content,status) VALUES('$url','$slug','$content',$status);");
		$query->execute();

	}

	public function getlastedpage(){
		$this->table = DBPREFIX."page";
		$query = $this->pdo->prepare("SELECT * FROM $this->table ORDER BY id DESC LIMIT 1;");
		$query->execute();
		$page = $query->fetchall();
        return $page;
	}

	public function savepagecat($id_page,$id_cat){
		$this->table = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("INSERT INTO $this->table (id_page,id_categorie) VALUES($id_page,$id_cat);");
		$query->execute();
	}

	public function pagedelete($id){
		$this->table = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_page = $id;");
		$query->execute();
		$this->table = DBPREFIX."page";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = $id;");
		$query->execute();
	}

	public function getpage($id){
		$this->table = DBPREFIX."page";
		$join = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = $id;");
		$query->execute();
		$page = $query->fetchall();
        return $page;

	}
	public function getallpage(){
		$this->table = DBPREFIX."page";
		$query = $this->pdo->prepare("SELECT * FROM $this->table ;");
		$query->execute();
		$page = $query->fetchall();
        return $page;

	}

	public function getCategoriesById($id){
		$this->table = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("SELECT id_categorie FROM $this->table WHERE id_page = $id ORDER BY id_categorie ; ");
		$query->execute();
		$cat = $query->fetchall();
		return $cat;
	}

	public function delatepagecat($id_page){
		$this->table = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_page = $id_page;");
		$query->execute();
	}

	public function createCat($name){
		$this->table = DBPREFIX."categorie";
		$query = $this->pdo->prepare("INSERT INTO $this->table (name) VALUES ('$name');");
		$query->execute();
	}

	public function deleteCat($id){
		$this->table = DBPREFIX."page_categorie";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id_categorie = $id;");
		$query->execute();
		$this->table = DBPREFIX."article";
		$query = $this->pdo->prepare("UPDATE $this->table SET id_categorie = NULL WHERE id_categorie = $id;");
		$query->execute();
		$this->table = DBPREFIX."categorie";
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = $id;");
		$query->execute();

	}

	public function getPageArticles($url){
		$page = DBPREFIX."page";
		$page_cat = DBPREFIX."page_categorie";
		$article = DBPREFIX."article";
		$query = $this->pdo->prepare("SELECT p.slug, p.content , a.title , a.content FROM $page as p , $page_cat as pc , $article as a WHERE p.id = pc.id_page and pc.id_categorie = a.id_categorie and p.url = '$url' and a.status = 1 ; ");
		$query->execute();
		$pagearticle = $query->fetchall();
		return $pagearticle;
	}

	public function getPageByUrl($url){
		$page = DBPREFIX."page";
		$query = $this->pdo->prepare("SELECT * FROM $this->table WHERE url = '$url' ; ");
		$query->execute();
		$page = $query->fetch();
		return $page;

	}

	public function getArticleByIdPage($id){
		$page_cat = DBPREFIX."page_categorie";
		$article = DBPREFIX."article";
		$query = $this->pdo->prepare("SELECT a.id, a.title , a.content FROM $page_cat as pc, $article as a WHERE pc.id_categorie = a.id_categorie and pc.id_page = $id and a.status = 1 and a.isDeleted = 0 ; ");
		$query->execute();
		$pagearticle = $query->fetchall();
		return $pagearticle;
	}

	public function existebd($valeur,$table,$columns){
		$table = DBPREFIX.$table;
		$query = $this->pdo->prepare("SELECT $columns FROM $table ; ");
		$query->execute();
		$db = $query->fetchall();
		foreach($db as $one){
			if(strtoupper($valeur) == strtoupper(htmlspecialchars_decode($one[$columns]))){
				return true;
			}
		}
		return false;
	}

	public function getallPageActif(){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare("SELECT * FROM $table WHERE status = 0 ;");
		$query->execute();
		$page = $query->fetchall();
		return $page;
	}

	public function removemenu($id){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare("UPDATE $table SET isMenu = 0 , isAccueil = 0 WHERE id = $id ;");
		$query->execute();
		
	}

	public function addmenu($id){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare("UPDATE $table SET isMenu = 1 WHERE id = $id ;");
		$query->execute();
	}

	public function maxmenu(){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare(" SELECT SUM(isMenu) AS nb_menu FROM $table ;");
		$query->execute();
		$page = $query->fetchall();
		return $page;
	}

	public function getpagemenu(){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare(" SELECT * FROM $table WHERE isMenu = 1 ;");
		$query->execute();
		$page = $query->fetchall();
		return $page;
	}

	public function getpageaccueil(){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare(" SELECT * FROM $table WHERE isAccueil = 1 ;");
		$query->execute();
		$page = $query->fetchall();
		return $page;
	}

	public function addaccueil($id){
		$table = DBPREFIX."page";
		$query = $this->pdo->prepare("UPDATE $table SET isMenu = 1 WHERE isAccueil = 1 ;");
		$query->execute();
		$query = $this->pdo->prepare("UPDATE $table SET isAccueil = 0 ;");
		$query->execute();
		$query = $this->pdo->prepare("UPDATE $table SET isAccueil = 1 WHERE id = $id ;");
		$query->execute();
		$query = $this->pdo->prepare("UPDATE $table SET isMenu = 0 WHERE isAccueil = 1 ;");
		$query->execute();
	}

	public function isAdmin($id){
		$table = DBPREFIX."editor";
		$query = $this->pdo->prepare(" SELECT * FROM $table WHERE id = $id and role = 1 ;");
		$query->execute();
		$user = $query->fetch();
		if(!empty($user)){
			return true;
		}
		else{
			return false;
		}

	}

	public function lastAdmin(){
		$table = DBPREFIX."editor";
		$query = $this->pdo->prepare(" SELECT * FROM $table WHERE role = 1 and isDeleted =0;");
		$query->execute();
		$users = $query->fetchall();
		$nb_user = count($users);
		if($nb_user <= 1){
			return true;
		}
		else{
			return false;
		}
	}

	public function getiduserbymail($email){
		$table = DBPREFIX."editor";
		$query = $this->pdo->prepare(" SELECT id FROM $table WHERE email = $email ;");
		$query->execute();
		$user = $query->fetchall();
		return $user;
	}




}
