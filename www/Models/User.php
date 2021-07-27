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
	protected $role =2;
	protected $isDeleted = 0;
	protected $emailVerified =0;

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

	public function setEmailVerified($emailVerified){
		$this->emailVerified = $emailVerified;
	}
	public function getEmailVerified(){
		return $this->emailVerified;
	}

	public function setUsername($username){
		$this->username = $username;
	}
	public function getUsername(){
		return $this->username;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setPwd($password){
		$this->password = $password;
	}
	public function getPassword(){
		return $this->password;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	public function getStatus(){
		return $this->status;
	}

	public function setRole($role){
		$this->role = $role;
	}
	public function getRole(){
		return $this->role;
	}

	public function setIsDeleted($isDeleted){
		$this->isDeleted = $isDeleted;
	}
	public function getIsdeleted(){
		return $this->isDeleted;
	}
	


	public function buildFormRegister(){
		return [
				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"S'inscrire",
					"class"=>"form"
				],
				"input"=>[
					"username"=>[
									"type"=>"text",
									"class"=>"form-input",
									"label"=>"Nom d&apos;utilisateur",
									"lengthMax"=>"120",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre nom d&apos;utilisateur doit faire entre 2 et 120 caractères",
									"placeholder"=>"Nom d&apos;utilisateur"
									],
                    "email"=>[
									"label"=>"Email",
									"class"=>"form-input",
									"type"=>"email",
									"lengthMax"=>"320",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre email doit faire entre 8 et 320 caractères",
									"placeholder"=>"Email"
									],
					"password"=>[
									"label"=>"Password",
									"class"=>"form-input",
									"type"=>"password",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre mot de passe doit faire plus de 8 caractères",
									"placeholder"=>"Mot de passe"
									],
					"pwdConfirm"=>[
									"label"=>"Confirmation Password",
									"class"=>"form-input",
									"type"=>"password",
									"confirm"=>"pwd",
									"required"=>true,
									"error"=>"Votre mot de passe de confirmation est incorrect",
									"placeholder"=>"Confirmation de mot de passe"
									]

									]


			];
	}
    public function buildFormLogin(){
        return [

            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"form",
				"Submit"=>"Connecter",
                "id"=>"form_login"
            ],
            "input"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "label"=>"Votre Email",
                    "required"=>true,
                    "class"=>"form-input",
                    "minLength"=>8,
                    "maxLength"=>320,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères"
                ],

                "password"=>[
					"label"=>"Votre mot de passe",
					"type"=>"password",
					"lengthMin"=>"8",
                    "class"=>"form-input",
					"required"=>true,
					"error"=>"Votre mot de passe doit faire plus de 8 caractères",
					"placeholder"=>"Votre mot de passe"
                ]
            ]

        ];
    }

}









