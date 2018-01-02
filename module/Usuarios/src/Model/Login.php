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
   
   private $messages=[
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
          switch ($result->getCode()) 
          {
          	case Result::SUCCESS:
          		if($result->isValid())
              {
          			$data = $this->authAdapter->getResultRowObject();
          			$this->auth->getStorage()->write($data);
          		}
          		else
          		{
                throw new RuntimeException($this->messages[self::INVALID_USER]);
          		}
          	break;
            case Result::FAILURE_IDENTITY_NOT_FOUND:
          	   throw new RuntimeException($this->messages[self::NOT_IDENTITY]);
            break;
            case Result::FAILURE_CREDENTIAL_INVALID:
               throw new RuntimeException($this->messages[self::INVALID_CREDENTIAL]);
            break;
          	default:
          		throw new RuntimeException($this->messages[self::INVALID_LOGIN]);
          	break;
          }
      }
      else
      {
        throw new RuntimeException($this->messages[self::INVALID_LOGIN]);
      }
      return $this;
   }

   public function setMessage($messageString, $messageKey=null)
   {
      if($messageKey==null)
      {
          $keys=arrays_keys($this->messages);
          $messageKey=current($keys);
      }
      if(!isset($this->messages[$messageKey]))
      {
         throw new RuntimeException('No messages exist for key');
      }

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