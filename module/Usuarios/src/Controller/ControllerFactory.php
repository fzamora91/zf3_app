<?php
namespace Usuarios\Controller;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Usuarios\Model\Dao\IUsuarioDao;
use Usuarios\Model\Login as lg;


class ControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container , $resquestedName , array $options=null)
    {
       $controller=null;
       switch ($resquestedName) 
       {
       	case UsuarioController::class :
       		$usuarioDao = $container->get(IUsuarioDao::class);
       		$controller = new UsuarioController($usuarioDao);
       		break;
        case LoginController::class:
               $login = $container->get(lg::class);
               $controller = new LoginController($login);
               break;
       	default:
       		return(null===$options)?new $resquestedName:new $resquestedName($options);
       		
       }
       return $controller;
    }
}