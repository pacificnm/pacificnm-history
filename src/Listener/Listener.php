<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Pacificnm\History\Entity\Entity;
use Pacificnm\History\Service\ServiceInterface;

class Listener implements ListenerAggregateInterface
{

    /**
     *
     * @var array
     */
    protected $listeners = array();

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @param ServiceInterface $service            
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * @param EventInterface $event            
     * @return \Pacificnm\History\Listener\Listener
     */
    public function pageLoaded(EventInterface $event)
    {
        $entity = new Entity();
        
        $entity->setAuthId($event->getParam('authId'));
        
        $entity->setHistoryRemoteAddress($_SERVER['REMOTE_ADDR']);
        
        $entity->setHistoryRemoteBrowser($_SERVER['HTTP_USER_AGENT']);
        
        $entity->setHistoryRequest($event->getParam('requestUrl'));
        
        $entity->setHistoryRequestTime(time());
        
        $entity->setHistoryRequestType($_SERVER['REQUEST_METHOD']);
        
        $entity->setHistoryRequestParams(json_encode($event->getParam('requestParams')));
        
        $this->service->save($entity);
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        $this->listeners = array(
            $events->attach('pageLoaded', array(
                $this,
                'pageLoaded'
            ))
        );
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::detach()
     */
    public function detach(\Zend\EventManager\EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
        
        return $this;
    }
}

