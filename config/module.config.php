<?php 
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
return array(
    'module' => array(
        'History' => array(
            'name' => 'History',
            'version' => '1.0.4',
            'install' => array(
                'require' => array(),
                'sql' => 'sql/history.sql'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'History\Controller\ConsoleController' => 'History\Controller\Factory\ConsoleControllerFactory',
            'History\Controller\CreateController' => 'History\Controller\Factory\CreateControllerFactory',
            'History\Controller\DeleteController' => 'History\Controller\Factory\DeleteControllerFactory',
            'History\Controller\IndexController' => 'History\Controller\Factory\IndexControllerFactory',
            'History\Controller\RestController' => 'History\Controller\Factory\RestControllerFactory',
            'History\Controller\UpdateController' => 'History\Controller\Factory\UpdateControllerFactory',
            'History\Controller\ViewController' => 'History\Controller\Factory\ViewControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'History\Service\ServiceInterface' => 'History\Service\Factory\ServiceFactory',
            'History\Mapper\MysqlMapperInterface' => 'History\Mapper\Factory\MysqlMapperFactory',
            'History\Form\Form' => 'History\Form\Factory\FormFactory',
            'History\Listener\Listener' => 'History\Listener\Factory\ListenerFactory',
        )
    ),
    'router' => array(
        'routes' => array(
            'history-create' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/history/create',
                    'defaults' => array(
                        'controller' => 'History\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'history-delete' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/history/delete/[:id]',
                    'defaults' => array(
                        'controller' => 'History\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'history-index' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/history',
                    'defaults' => array(
                        'controller' => 'History\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'history-rest' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'Rest',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'rest',
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/history[/:id]',
                    'defaults' => array(
                        'controller' => 'History\Controller\RestController',
                    )
                )
            ),
            'history-update' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/history/update/[:id]',
                    'defaults' => array(
                        'controller' => 'History\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'history-view' => array(
                'pageTitle' => 'History',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'history-index',
                'icon' => 'fa fa-history',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/history/view/[:id]',
                    'defaults' => array(
                        'controller' => 'History\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'history-console-index' => array(
                    'options' => array(
                        'route' => 'history --list [--email=] [--page=]',
                        'defaults' => array(
                            'controller' => 'History\Controller\ConsoleController',
                            'action' => 'index'
                        )
                    )
                ),
                'history-console-view' => array(
                    'options' => array(
                        'route' => 'history --view [--id=]',
                        'defaults' => array(
                            'controller' => 'History\Controller\ConsoleController',
                            'action' => 'view'
                        )
                    )
                )
            )
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'view_helpers' => array(
        'factories' => array(
            'HistorySearchForm' => 'History\View\Helper\Factory\HistorySearchFormFactory'
        ),
    ),
    'acl' => array(
        'default' => array(
            'guest' => array(),
            'administrator' => array(
                'history-create',
                'history-delete',
                'history-index',
                'history-update',
                'history-view'
            )
        )
    ),
    'menu' => array(
        'default' => array(
            array(
                'key' => 'admin',
                'name' => 'Admin',
                'icon' => 'fa fa-gear',
                'order' => 99,
                'active' => true,
                'location' => 'left',
                'items' => array(
                    array(
                        'key' => 'history-index',
                        'name' => 'History',
                        'route' => 'history-index',
                        'icon' => 'fa fa-history',
                        'order' => 100,
                        'active' => true
                    )
                )
            )
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'History',
                        'route' => 'history-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View',
                                'route' => 'history-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'history-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'history-delete',
                                        'useRouteMatch' => true,
                                    )
                                )
                            ),
                            array(
                                'label' => 'New',
                                'route' => 'history-create',
                                'useRouteMatch' => true,
                            )
                        )
                    )
                )
            )
        )
    )
);