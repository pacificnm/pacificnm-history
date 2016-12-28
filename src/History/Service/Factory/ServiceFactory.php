<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use History\Service\Service;

class ServiceFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \History\Service\Service
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('History\Mapper\MysqlMapperInterface');

        return new Service($mapper);
    }


}

