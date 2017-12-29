<?php
namespace Usuarios;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Authentication\AuthenticationService;

return [
    'controllers' => [
        'factories' => [
            AuthenticationService::class => InvokableFactory::class,
            Controller\UsuarioController::class => Controller\ControllerFactory::class,
            Controller\LoginController::class => Controller\ControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'login' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/login[/:action]',
                    'defaults' => [
                        'controller'    => Controller\LoginController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
            'usuarios' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/usuarios[/:action]',
                    'defaults' => [
                        'controller'    => Controller\UsuarioController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'usuarios' => __DIR__ . '/../view',
        ],
    ],
];
