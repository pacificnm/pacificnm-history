<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use History\Controller\ConsoleController;

class ConsoleControllerFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \History\Controller\ConsoleContorller
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $service = $realServiceLocator->get('History\Service\ServiceInterface');
        $console = $realServiceLocator->get('console');
        return new ConsoleController($service, $console);
    }


}

