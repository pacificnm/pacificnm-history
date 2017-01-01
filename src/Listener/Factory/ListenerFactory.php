<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\History\Listener\Listener;

class ListenerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\History\Listener\Listener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('Pacificnm\History\Service\ServiceInterface');
        
        return new Listener($service);
    }
}

