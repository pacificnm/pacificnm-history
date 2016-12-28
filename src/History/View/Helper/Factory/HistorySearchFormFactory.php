<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use History\View\Helper\HistorySearchForm;

class HistorySearchFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \History\View\Helper\HistorySearchForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new HistorySearchForm();
    }
}

