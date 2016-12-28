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
use History\Controller\ViewController;

class ViewControllerFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \History\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $service = $realServiceLocator->get('History\Service\ServiceInterface');

        return new ViewController($service);
    }


}

