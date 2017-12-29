<?php
namespace Usuarios\Model;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as authAdapter;
use Zend\Authentication\Result;
use Zend\View\Exception\RuntimeException;

class Login
{
   private $auth;
   private $authAdapter;

   const NOT_IDENTITY="notIdentity";
   const INVALID_CREDENTIAL="invalidCredential";
   const INVALID_USER="invalidUser";
   const INVALID_LOGIN="invalidLogin";
   
   protected $messages=[
   	  self::NOT_IDENTITY=>"no identity",
      self::INVALID_CREDENTIAL=>"invalid credential",
      self::INVALID_USER=>"invalid user",
      self::INVALID_LOGIN=>"invalid Login"
   ];

   public function __construct($dbAdapter, AuthenticationService $authService)
   {
   	  $this->authAdapter = new AuthAdapter($dbAdapter,'usuarios','email','pwd'); 
      $this->auth=$authService;
   }

   public function login($identifier, $password)
   {
      if(!empty($identifier) && !empty($password))
      {
          $this->authAdapter->setIdentity($identifier);
          $this->authAdapter->setCredential($password);
          $result = $this->auth->authenticate($this->authAdapter);
          switch ($result->getCode()) {
          	case Result::SUCCESS:
          		if($result->isInvalid()){
          			$data = $this->authAdapter->getResultObject();
          			$this->auth->getStorage()->write($data);
          		}
          		else
          		{

          		}
          		break;
          	
          	default:
          		# code...
          		break;
          }
      }
   }

   public function setMessage($messageString, $messageKey=null)
   {
   	  
   	  $this->messages[$messageKey]=$messageString;
      return $this;
   }
   
   public function logout()
   {
   	  $this->auth->clearIdentity();
      return $this;
   }

   public function getIdentity()
   {
   	  if($this->auth->hasIdentity()){
      	return $this->auth->getIdentity();
      }
      return null;
   }

   public function hasIdentity()
   {
     return $this->auth->hasIdentity();
   }

   public function isLoggedIn()
   {
       return $this->auth->hasIdentity();
   }

}