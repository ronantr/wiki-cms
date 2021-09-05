<?php
namespace App\Core;

use App\Core\Database;
use App\Models\User;
use App\Core\ConstantManager;
use App\Core\Helpers;

class Installer 
{
    
    protected static $query;



    public function checkInstall(){
        if(!$this->checkEnvExist()){
            return true;
        }else{return false;}

    }
    
    public function install(){
        $this->editEnvFiles($_POST['data'],$_POST );
        $install = $this->makeDatabase();

        if($install > 0){
            session_write_close();
            
            header('location: /login');
            
        } else{
            session_write_close();
            header('location : /installer?message=2');
        }

        
    }
    public function makeDatabase(){
        if(file_exists('.env.prod')){
        $query = file_get_contents('Dump.sql');}
        
        $install = $this->createDatabase($query);
        $install = $this->renameDatabase($_POST ['data']['DBPREFIX']);
        echo'<h1>actualiser la page</h1>';
        $this->creationUser($_POST['user']);
        return $install;
    }

    public function getDatabase() {
        $dump = file_get_contents('dump.sql');
            return $dump;
        }
    

    public function checkEnvExist() {
        if(file_exists('.env') ||   file_exists('.env.prod')) {
            return true;
        }
        return false;
    }
    public function checkDatabaseConnection() {
        try {
            $conn = new \PDO(
                "mysql:dbname=".$_POST['data']['DBNAME']. ";host=" 
                .$_POST ['data']['DBHOST'].";port=".$_POST['data']['DBPORT'],
                $_POST ['data']['DBUSER'],
                $_POST ['data']['DBPWD']);
            return true;
        }catch(Exception $e){
            return false;
			die ("Erreur SQL ".$e->getMessage());
		}
    }
    public function editEnvFiles($db) {
        $env = ".env";
        $env_prod = ".env.prod";
        $this->EnvFile($env);
        $this->EnvProdFile($env_prod,$db);
    }

    public function EnvProdFile($env_prod, $db) {
        $content_envprod = "";
        $content_envprod .= "DBDRIVER=mysql". PHP_EOL;
        foreach($db as $key => $value){
            //echo $key." - ".$value.'<br>';
            $content_envprod .= strtoupper($key) . "=" . $value . PHP_EOL;
        }

        file_put_contents($env_prod, $content_envprod);
    }

    public function EnvFile($env) {
        $content_env = "APP_NAMESPACE=\App\ ".PHP_EOL;
        $content_env .= "ENV=prod". PHP_EOL;
        file_put_contents($env, $content_env);
    }
public function createDatabase($query) {
        $conn = new \PDO(
            "mysql:dbname=".$_POST['data']['DBNAME']. ";host=" 
            .$_POST ['data']['DBHOST'].";port=".$_POST['data']['DBPORT'],
            $_POST ['data']['DBUSER'],
            $_POST ['data']['DBPWD']);
        $query = $conn->exec($query);
        return true;
	}
	
	public function renameDatabase($DBPREFIXe){
        $conn = new \PDO(
            "mysql:dbname=".$_POST['data']['DBNAME']. ";host=" 
            .$_POST ['data']['DBHOST'].";port=".$_POST['data']['DBPORT'],
            $_POST ['data']['DBUSER'],
            $_POST ['data']['DBPWD']);
		$DBPREFIX_article = $DBPREFIXe."article";
		$DBPREFIX_categorie = $DBPREFIXe."categorie";
		$DBPREFIX_commentaire = $DBPREFIXe."commentaire";
		$DBPREFIX_editor = $DBPREFIXe."editor";
		$DBPREFIX_static = $DBPREFIXe."static";
		$DBPREFIX_page_categorie = $DBPREFIXe."page_categorie";
		$DBPREFIX_page = $DBPREFIXe."page";
		$query = $conn->prepare("alter table article rename  TO $DBPREFIX_article ;");
		$query->execute();
		$query = $conn->prepare("alter table commentaire rename  TO $DBPREFIX_commentaire ;");
		$query->execute();
		$query = $conn->prepare("alter table editor rename  TO $DBPREFIX_editor ;");
		$query->execute();
		$query = $conn->prepare("alter table categorie rename  TO $DBPREFIX_categorie ;");
		$query->execute();
		$query = $conn->prepare("alter table static rename  TO $DBPREFIX_static ;");
		$query->execute();
		$query = $conn->prepare("alter table page rename  TO $DBPREFIX_page ;");
		$query->execute();
		$query = $conn->prepare("alter table page_categorie rename  TO $DBPREFIX_page_categorie ;");
		$query->execute();
        $query = $conn->prepare("DROP TABLE `article`, `categorie`, `commentaire`, `editor`, `page`, `page_categorie`, `static`;");
        $query->execute();
		return true;

	}
    public function creationUser($user) {
        
        $userf = new User();
        var_dump($user);
        $Password = password_hash(htmlspecialchars($user['Password']), PASSWORD_BCRYPT);
        $userf->setUsername($user['Username']);
        $userf->setEmail($user['Email']);
        $userf->setPwd($Password);
        $userf->setRole("1");
        $userf->setToken("");
        $userf->setEmailVerified("1");
        //$userf->setIsDeleted(0);
        var_dump($userf);
        $userf->save();
    }

}