<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Controller;

use Zend\View\Model\ViewModel;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\History\Service\ServiceInterface;

class ViewController extends AbstractApplicationController
{

    protected $service = null;

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
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $id = $this->params()->fromRoute('id');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Object was not found');
            return $this->redirect()->toRoute('history-index');
        }
        
        $this->getEventManager()->trigger('historyView', $this, array(
            'authId' => $this->identity()
                ->getAuthId(),
            'requestUrl' => $this->getRequest()
                ->getUri(),
            'historyEntity' => $entity
        ));
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

