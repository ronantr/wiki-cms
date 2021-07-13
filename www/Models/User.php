<?php
namespace App\Models;

use App\Core\Database;

class User extends Database
{
	private $id=null;
	protected $username;
	protected $email;
	protected $password;
	//protected $status = 0;
	//protected $role = 0;
	//protected $isDeleted = 0;

	public function __construct(){
		parent::__construct();
	}
	public function setId($id){
		//Il va chercher en BDD toutes les informations de l'utilisateur
		//et il va alimenter l'objet avec toutes ces données
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}
	public function setUsername($username){
		$this->username = $username;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setPwd($password){
		$this->password = $password;
	}
	//public function setStatus($status){
	//	$this->status = $status;
	//}
	//public function setRole($role){
	//	$this->role = $role;
	//}
	//public function setIsDeleted($isDeleted){
	//	$this->isDeleted = $isDeleted;
	//}


	public function buildFormRegister(){
		return [
				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"S'inscrire",
					"class"=>"form_register"
				],
				"input"=>[
					"username"=>[
									"type"=>"text",
									"class"=>"form_input",
									"label"=>"Prénom",
									"lengthMax"=>"120",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre prénom doit faire entre 2 et 120 caractères",
									"placeholder"=>"Votre prénom"
									],
                    "email"=>[
									"type"=>"email",
									"lengthMax"=>"320",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre email doit faire entre 8 et 320 caractères",
									"placeholder"=>"Votre email"
									],
					"password"=>[
									"type"=>"password",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre mot de passe doit faire plus de 8 caractères",
									"placeholder"=>"Votre mot de passe"
									],
					"pwdConfirm"=>[
									"type"=>"password",
									"confirm"=>"pwd",
									"required"=>true,
									"error"=>"Votre mot de passe de confirmation est incorrect",
									"placeholder"=>"Confirmation"
									]
				]

			];
	}
    public function buildFormLogin(){
        return [

            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"form_login",
				"Submit"=>"Ce Connecter",
                "id"=>"form_login"
            ],
            "input"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "label"=>"Votre Email",
                    "required"=>true,
                    "class"=>"form_input",
                    "minLength"=>8,
                    "maxLength"=>320,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères"
                ],

                "password"=>[
					"type"=>"password",
					"lengthMin"=>"8",
					"required"=>true,
					"error"=>"Votre mot de passe doit faire plus de 8 caractères",
					"placeholder"=>"Votre mot de passe"
                ]
            ]

        ];
    }

}









