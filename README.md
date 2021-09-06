# MVC CMS IWG42

Annual project for the 3rd year of the Bachelor in Web Engineering at ESGI.

Design of a CMS from scratch only written in php which allows any company to create their own website from our solution.


## Requirements
* [Install Docker](https://docs.docker.com/get-docker/) (with [docker-compose](https://docs.docker.com/compose/install/))

## Getting Started
Make a git clone of this repository and in the created folder, run this command line :
```sh
docker-compose up -d
```

## Usage
With the current docker-compose.yml, go to [http://localhost](http://localhost) for the web application and [http://localhost:8888](http://localhost:8888) to acces phpMyAdmin.

## Database
DBHOST : database

DBNAME : wiki

DBUSER : root

DBPWD  : password

DBPORT : 3306

## Contributors
* **Chaochao Zhou** - [Chaochao-z](https://github.com/Chaochao-z)
* **Ronan Trouillard** - [ronantr](https://github.com/ronantr)

## Utilisation

Les doits :
    -Utilisateur : Visualiser les pages , les articles publié ; Commenter les articles (Connecter et compte vérifier) .
    -Editeur : Créer Editer Supprimer les Pages ; Catégorie ; Articles ; Commentaire ; Consuslter le Dashboard .
    -Administrateur : Gestion des Users ; Gestion des menus ; Gestion des Templates .

