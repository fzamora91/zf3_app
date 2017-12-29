<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Model\Dao\IUsuarioDao;

class UsuarioController extends AbstractActionController
{
    private $usuarioDao;
    public function __construct(IUsuarioDao $usuarioDao)
    {
       $this->usuarioDao = $usuarioDao;
    }

    public function indexAction()
    {
        return ['titulo'=>'Lista de usuario','usuarios'=>$this->usuarioDao->obtenerTodos()];
    }

}
