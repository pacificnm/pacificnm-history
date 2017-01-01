<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History;

use Zend\Mvc\MvcEvent;
use Zend\Console\Adapter\AdapterInterface as Console;

class Module
{

    /**
     * 
     * @param Console $console
     * @return string[]
     */
    public function getConsoleUsage(Console $console)
    {
        return array(
            'history --list [--email=] [--page=]' => 'List history events. Search by email',
            'history --view [--id=]' => 'View history event by id'
        );
    }

    /**
     *
     * @param MvcEvent $e            
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        
        $sharedEventManager = $eventManager->getSharedManager();
        
        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array(
            $this,
            'historyEventController'
        ), 90);
    }

    /**
     *
     * @param MvcEvent $e            
     */
    public function historyEventController(MvcEvent $e)
    {
        $controller = $e->getTarget();
        
        $controller->getEventManager()->attachAggregate($controller->getServiceLocator()
            ->get('Pacificnm\History\Listener\Listener'));
    }


    public function getConfig()
    {
        return include __DIR__ . '/../config/pacificnm.history.global.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/'
                )
            )
        );
    }
}

