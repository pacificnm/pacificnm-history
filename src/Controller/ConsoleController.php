<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Zend\Console\Adapter\AdapterInterface;
use History\Service\ServiceInterface;

class ConsoleController extends AbstractActionController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service = null;

    /**
     *
     * @var AdapterInterface
     */
    protected $console = null;

    /**
     *
     * @param ServiceInterface $service            
     * @param AdapterInterface $console            
     */
    public function __construct(ServiceInterface $service, AdapterInterface $console)
    {
        $this->service = $service;
        
        $this->console = $console;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
        $table = new \Zend\Text\Table\Table(array(
            'columnWidths' => array(
                10,
                20,
                70,
                10,
                5,
                10
            )
        ));
        
        $table->appendRow(array(
            'History Id',
            'Auth',
            'Request',
            'Time',
            'Type',
            'Ip Address'
        ));
        
        $filter = array(
            'page' => $this->params()->fromRoute('page', 1),
            'count-per-page' => $this->params()->fromRoute('count-per-page', 25),
            'authEmail' => $this->params()->fromRoute('email', null)
        );
        
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        foreach ($paginator as $entity) {
            if($entity->getAuthId() > 0) {
                $auth = $entity->getAuthEntity()->getAuthEmail();
            } else {
                $auth = 'Guest';
            }
            
            $table->appendRow(array(
                $entity->getHistoryId(),
                $auth,
                $entity->getHistoryRequest(),
                date("m/d/Y h:i A", $entity->getHistoryRequestTime()),
                $entity->getHistoryRequestType(),
                $entity->getHistoryRemoteAddress()
            ));
        }
        
        echo $table;
        
        $this->console->write("Page {$filter['page']} of {$paginator->count()} pages\n");
        $this->console->write("{$paginator->getTotalItemCount()} total items\n");
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Comleted history list at {$end}\n");
    }

    public function viewAction()
    {
        // validate we are in a console
        if (! $this->request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($this->request));
        }
        
        $table = new \Zend\Text\Table\Table(array(
            'columnWidths' => array(
                10,
                20,
                70,
                10,
                5,
                10
            )
        ));
        
        $table->appendRow(array(
            'History Id',
            'Auth',
            'Request',
            'Time',
            'Type',
            'Ip Address'
        ));
        
        $entity = $this->service->get($this->params()->fromRoute('id'));
        
        if($entity->getAuthId() > 0) {
            $auth = $entity->getAuthEntity()->getAuthEmail();
        } else {
            $auth = 'Guest';
        }
        
        $table->appendRow(array(
            $entity->getHistoryId(),
            $auth,
            $entity->getHistoryRequest(),
            date("m/d/Y h:i A", $entity->getHistoryRequestTime()),
            $entity->getHistoryRequestType(),
            $entity->getHistoryRemoteAddress()
        ));
        
        echo $table;
        
        $end = date('m/d/Y h:i a', time());
        
        $this->console->write("Comleted history view at {$end}\n");
    }
}

