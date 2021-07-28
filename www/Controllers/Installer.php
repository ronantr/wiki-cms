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
        if($installer->checkEnvExist() == "false") {
            
            $view = new View("installer", "installer");
            $view->assign("title","Installer");
        } else {
            header('location: / ');
        }
    }

    public function makeInstallAction() {
        $installer = new CoreInstaller();
        if($installer->checkDatabaseConnection()) {
            $installer->install();
            echo 'Saisir les champs';
        } else {
            session_write_close();
            header('location: /installer?message=1');
            echo'Connexion à la base de données impossible';
        }
    }





}