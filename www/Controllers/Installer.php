<?php

namespace App;

use App\Core\View;
use App\Models\User;
use App\Core\Form;
use App\Core\Installer as CoreInstaller;
use App\Core\Routing;

class Installer
{
    public function initialisationAction(){

        $installer = new CoreInstaller();
        if($installer->checkEnvExist() == 'false') {
            
            $view = new View("installer", "installer");
            $view->assign("title","Installer");
        } else {
            header('location: / ');
        }
    }

    public function makeInstallAction() {
        if(!empty($_POST)){
            $installer = new CoreInstaller();
            if($installer->checkDatabaseConnection()) {
                $installer->install();
            } else {
                
                header('location: /installer?message=1');
                echo'Connexion à la base de données impossible';
            }
        }
        else{
            header('Location: /');
        }
        
    }

    public function makeadminAction(){
        $user = new User;
        $nb_user= count($user->searchadmin());
        if($nb_user == 0){
            $user = new User();
            $view = new View("register","installer");
            $view->assign("title","Register Admin");
            $form = $user->buildFormRegister();
            if(!empty($_POST)){
                $errors = Form::validator($_POST, $form);
                //var_dump($form);
                //print"<br>";
                //var_dump($_POST);
                if(empty($errors)){
                    if($_POST['password'] == $_POST['pwdConfirm']){
                        $user->setUsername($_POST["username"]);
                        $user->setEmail(htmlspecialchars($_POST["email"]));
                        $user->setPwd(password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT));
                        $user->setRole(1);
                        $user->setIsDeleted(0);
                        $user->setEmailVerified(0);
                        $user->save();
                        header("Location: /login");
                    }
                    else{
                        $errors[0]="Confirmer votre mdp";
                        $view->assign("formErrors", $errors);
                    }
                    //
                    
                    //var_dump($user);
                }else{
                    $view->assign("formErrors", $errors);
                }
            }
            $view->assign("form", $form);
            
        

        }
        else{
            header('Location: /');
        }
    }





}
