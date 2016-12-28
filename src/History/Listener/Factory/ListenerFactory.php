<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use History\Listener\Listener;

class ListenerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \History\Listener\Listener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('History\Service\ServiceInterface');
        
        return new Listener($service);
    }
}

