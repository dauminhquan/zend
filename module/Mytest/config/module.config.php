<?php

namespace Mytest;
use Zend\Router\Http\Literal;
use Mytest\Controller\IndexController;
use Zend\ServiceManager\Factory\InvokableFactory;
return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/mytest',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'index',
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
            
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',



        //

        'template_map' => [
            'layout/mytest' => __DIR__ . '/../view/layout/mytest.phtml',
            'layout/test' => __DIR__ . '/../view/layout/testlayout.phtml',
            'mytest/index/index' => __DIR__.'/../view/mytest/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'layout' => 'layout/mytest',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];
