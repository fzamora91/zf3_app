<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios;
use Zend\Mvc\MvcEvent;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Zend\serviceManager\Factory\InvokableFactory;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Usuarios\Model\Entity\Usuario;
use Usuarios\Model\Dao\IUsuarioDao;
use Usuarios\Model\Dao\UsuarioDao;
use Usuarios\Model\Login as lg;


class Module
{

    public function onBootstrap($e)
    {
        $eventManager=$e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH,[$this,'initAuth'],100);
    }

    public function initAuth(MvcEvent $e)
    {
      $application = $e->getApplication();
      $serviceManager = $application->getServiceManager();
      $auth = $serviceManager->get(lg::class);

      //pasamos el objeto auth al layout
      $layout = $e->getViewModel();
      $layout->auth=$auth;

      $matches = $e->getRouteMatch();
      $controllerName = $matches->getParam('controller');
      $action = $matches->getParam('action');

      switch ($controllerName) {
        case Controller\LoginController::class:
          # code...
          if(in_array($action, ['index','autenticar']))
          {
            //$matches->setParam('controller',Controller\LoginController::class);
            //$matches->setParam('action','index');
            return;
          }
        break;
        case Controller\UsuarioController::class:
          # code...
          if(in_array($action, ['index']))
          {
            //$matches->setParam('controller',Controller\LoginController::class);
            //$matches->setParam('action','index');
            return;
          }
        break;   
        
      }
      if(!$auth->isLoggedIn())
      {
         $matches->setParam('controller',Controller\LoginController::class);
         $matches->setParam('action','index');
      }
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
    	return[
             'factories'=> [
                 AuthenticationService::class => InvokableFactory::class,
                 lg::class => function($sm){
                           $dbAdapter = $sm->get(AdapterInterface::class);
                           $authService = $sm->get(AuthenticationService::class);
                           return new Lg($dbAdapter, $authService);
                  },
             	   'UsuariosTableGateway' => function($sm){
                              $dbAdapter=$sm->get(AdapterInterface::class);
                              $resultSetPrototype = new ResultSet();
                              $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                              return new TableGateway('usuarios',$dbAdapter,null,$resultSetPrototype);
                  },
                  IUsuarioDao::class => function($sm){
                            	$TableGateway=$sm->get('UsuariosTableGateway');
                            	$dao = new UsuarioDao($TableGateway);
                            	return $dao;
                  },
             ],
             'aliases'=>[
                           'auth_service'=>AuthenticationService::class,
                        ],
                        
    	];
    }
}
