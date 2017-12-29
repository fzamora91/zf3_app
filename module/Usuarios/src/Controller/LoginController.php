<?php
namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Login as LoginForm;
use Usuarios\Form\LoginValidator;
use Usuarios\Form\Login as LoginService;
use Usuarios\Model\Login as lg;

class LoginController extends AbstractActionController
{
   private $login;
   public function __construct(lg $login)
   {
     $this->login=$login;
   }

   public function indexAction()
   {
        return ['titulo'=>'Login', 'form'=>new LoginForm("Login"), 'identity'=>$this->login->getIdentity()];
   }

   public function autenticarAction()
   {
   	 if(!$this->request->isPost())
   	 {
        $this->redirect()->toRoute('login',['action'=>'index']);
   	 }

   	 $form=new LoginForm("login");
   	 $form->setInputFilter(new LoginValidator());

   	 $data = $this->request->getPost();
   	 $form->setData($data);


   	 //validamos el form
   	 if(!$form->isValid())
   	 {
   	 	$modelView = new ViewModel();
   	 	$modelView->setTemplate('usuarios/login/index');
   	 	return $modelView; 
   	 }
   	 $values=$form->getData();
   	 try
   	 {
   	 	$this->login->setMessage("El nombre de usuario y la contraseña");
   	 	$this->login->setMessage("La contraseña ingresada es la correcta");
   	 	$this->login->login($values['email'],$values['pwd']);
        $this->flashMessenger()->addSuccessMessage("Has iniciado sesion con exito");
        return $this->redirect()->toRoute('login',['action'=>'success']);
   	 }
   	 catch(RuntimeException $e)
   	 {
        return $this->redirect()->toRoute('login',['action'=>'index']);
   	 }
   }
   public function successAction()
   {
   	  return $this->redirect()->toRoute('usuarios',['action'=>'index']); 
   }
   
   public function logoutAction()
   {
   	 $this->login->logout();
   	 return $this->redirect()->toRoute('login',['action'=>'index']);
   }

}