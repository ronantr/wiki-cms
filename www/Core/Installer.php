<?php
namespace App\Core;

use App\Core\Database;
use App\Models\User;
use App\Core\ConstantManager;

class Installer 
{
    
    protected static $query;



    public function checkInstall(){
        if(!$this->checkEnvExist()){
            return true;
        }else{return false;}

    }
    
    public function install(){
        echo'test';
        $this->editEnvFiles($_POST['data'],$_POST );
        $install = $this->makeDatabase();

        if($install > 0){
            session_write_close();
            $this->creationUser($_POST['user']);
            header('location: /login');
            
        } else{
            session_write_close();
            header('location : /installer?message=2');
        }

        
    }
    public function makeDatabase(){
        $query = file_get_contents('Dump.sql');
        $db = new Database();
        //new ConstantManager();
        $install = $db->createDatabase($query);
        $install = $db->renameDatabase();
        return $install;
    }

    public function getDatabase() {
        $dump = file_get_contents('dump.sql');
            return $dump;
        }
    

    public function checkEnvExist() {
        if( file_exists('.env') || file_exists('.env.prod')) {
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
            echo $key." - ".$value.'<br>';
            $content_envprod .= strtoupper($key) . "=" . $value . PHP_EOL;
        }

        file_put_contents($env_prod, $content_envprod);
    }

    public function EnvFile($env) {
        $content_env = "APP_NAMESPACE=\App\ ".PHP_EOL;
        $content_env .= "ENV=prod". PHP_EOL;
        file_put_contents($env, $content_env);
    }

    public function creationUser($user) {
        $userf = new User();
        $userf->setUsername($user['Username']);
        $userf->setEmail($user['Email']);
        $userf->setPwd(password_hash(htmlspecialchars($user['Password']), PASSWORD_BCRYPT));
        $userf->setRole("1");
        $userf->setIsDeleted(0);
        //$user->setIsVerified(1);
        $userf->save();
    }

}