<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Helpers;

class User extends Database
{
	private $id=null;
	protected $username;
	protected $email;
	protected $password;
	//protected $status = 0;
	protected $role ;
	protected $isDeleted ;
	protected $tokenemail;
	protected $emailVerified;

	public function __construct(){
		parent::__construct();
		
		
	}
    /**
    * @param $id
    */
	public function setId($id){
		//Il va chercher en BDD toutes les informations de l'utilisateur
		//et il va alimenter l'objet avec toutes ces données
		$this->id = $id;
	}
	/**
    * @return mixed
    */
	public function getId(){
		return $this->id;
	}
    /**
    * @param $emailVerified
    */
	public function setEmailVerified($emailVerified){
		$this->emailVerified = $emailVerified;
	}
	/**
    * @return mixed
    */
	public function getEmailVerified(){
		return $this->emailVerified;
	}
	/**
     * @param $tokenemail
     */
    public function setToken($tokenemail){
        $this->tokenemail = $tokenemail;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->tokenemail;
    }
    /**
    * @param $username
    */
	public function setUsername($username){
		$this->username = $username;
	}
	/**
    * @return mixed
    */
	public function getUsername(){
		return $this->username;
	}
    /**
    * @param $email
    */
	public function setEmail($email){
		$this->email = $email;
	}
	/**
    * @return mixed
    */
	public function getEmail(){
		return $this->email;
	}
    /**
    * @param $password
    */
	public function setPwd($password){
		$this->password = $password;
	}
	/**
    * @return mixed
    */
	public function getPassword(){
		return $this->password;
	}
    /**
    * @param $status
    */
	public function setStatus($status){
		$this->status = $status;
	}
	/**
    * @return mixed
    */
	public function getStatus(){
		return $this->status;
	}
    /**
    * @param $role
    */
	public function setRole($role){
		$this->role = $role;
	}
	/**
    * @return mixed
    */
	public function getRole(){
		return $this->role;
	}
    /**
    * @param $isDeleted
    */
	public function setIsDeleted($isDeleted){
		$this->isDeleted = $isDeleted;
	}
	/**
    * @return mixed
    */
	public function getIsdeleted(){
		return $this->isDeleted;
	}
	


	public function buildFormRegister(){
		return [
				"config"=>[
					"method"=>"POST",
					"Action"=>"",
					"Submit"=>"S'inscrire",
					"class"=>"form_register"
				],
				"input"=>[
					"tokenemail"=>[
						"type"=>"hidden",
						"defaultValue"=>Helpers::generateCsrfToken()
					],
					"username"=>[
									"type"=>"text",
									"class"=>"form_input",
									"label"=>"Nom Prénom",
									"lengthMax"=>"50",
									"lengthMin"=>"2",
									"required"=>true,
									"error"=>"Votre prénom doit faire entre 2 et 50 caractères",
									"placeholder"=>"Votre prénom"
									],
                    "email"=>[
									"label"=>"Email",
									"type"=>"email",
									"lengthMax"=>"320",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre email doit faire entre 8 et 320 caractères",
									"placeholder"=>"Votre email"
									],
					"password"=>[
									"label"=>"Password",
									"type"=>"password",
									"lengthMin"=>"8",
									"required"=>true,
									"error"=>"Votre mot de passe doit faire plus de 8 caractères",
									"placeholder"=>"Votre mot de passe"
									],
					"pwdConfirm"=>[
									"label"=>"Confirmation Password",
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
				"Submit"=>"Connecter",
                "id"=>"form_login"
            ],
            "input"=>[
				"tokenemail"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
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
					"label"=>"Votre mot de passe",
					"type"=>"password",
					"lengthMin"=>"8",
					"required"=>true,
					"error"=>"Votre mot de passe doit faire plus de 8 caractères",
					"placeholder"=>"Votre mot de passe"
                ]
            ]

        ];
    }
	/**
     * @return array
     */
    public function buildFormResetPasswordEmail(){

        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
				"class"=>"form_password",
                "Submit"=>"Envoyer",
				"id"=>"form_password"
            ],
            "input"=>[
                "tokenemail"=>[
                    "type"=>"hidden",
                    "defaultValue"=>Helpers::generateCsrfToken()
                ],
                "email"=>[
                    "class"=>"requiredLabel",
                    "id"=>"email",
                    "type"=>"email",
                    "label"=>"Adresse Mail",
                    "lengthMin"=>"8",
                    "lengthMax"=>"320",
                    "required"=>true,
                    "error"=>"Votre email doit faire entre 8 et 320 caractères",
                    "placeholder"=>"Votre email"
                ],
            ],
        ];
		
    }
	public function buildFormResetPassword(){

        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
				"class"=>"form_password",
                "Submit"=>"Envoyer",
				"id"=>"form_password"
            ],
            "input"=>[
				"email"=>[
                    "type"=>"hidden",
                    "defaultValue"=>$_GET['email']
                ],
				"token"=>[
                    "type"=>"hidden",
                    "defaultValue"=>$_GET['token']
                ],
                "password"=>[
					"label"=>"Password",
					"type"=>"password",
					"lengthMin"=>"8",
					"required"=>true,
					"error"=>"Votre mot de passe doit faire plus de 8 caractères",
					"placeholder"=>"Votre mot de passe"
					],
				"pwdConfirm"=>[
					"label"=>"Confirmation Password",
					"type"=>"password",
					"confirm"=>"pwd",
					"required"=>true,
					"error"=>"Votre mot de passe de confirmation est incorrect",
					"placeholder"=>"Confirmation"
					]
            ]
        ];
	}

}









