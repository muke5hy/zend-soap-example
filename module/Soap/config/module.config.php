<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Soap;

use Soap\Controller;
use Soap\Model;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'wsdl' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/soap/wsdl',
                    'defaults' => [
                        'controller' => Controller\SoapController::class,
                        'action'     => 'wsdl',
                    ],
                ],
            ],
            'soap' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/soap/server',
                    'defaults' => [
                        'controller' => Controller\SoapController::class,
                        'action'     => 'server',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\SoapController::class => Controller\Factory\SoapControllerFactory::class,

        ],
    ],
    'service_manager' =>[
        'factories' => [
            Model\Env::class => Model\Factory\EnvModelFactory::class
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
