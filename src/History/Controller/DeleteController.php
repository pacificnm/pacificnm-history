<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Controller;

use Application\Controller\AbstractApplicationController;
use Zend\View\Model\ViewModel;
use History\Service\ServiceInterface;

class DeleteController extends AbstractApplicationController
{

    protected $service = null;

    /**
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();

        $this->flashMessenger()->addSuccessMessage('Action not enabled');
        
        return $this->redirect()->toRoute('history-index');
        
        $id = $this->params()->fromRoute('id');

        $entity = $this->service->get($id);

        if (! $entity) {
        	$this->flashmessenger()->addErrorMessage('Object was not found.');
        	return $this->redirect()->toRoute('history-index');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
        	$del = $request->getPost('delete_confirmation', 'no');
        	if ($del === 'yes') {
        		$this->service->delete($entity);

        		$this->getEventManager()->trigger('historyDelete', $this, array(
        			'authId' => $this->identity()->getAuthId(),
        			'requestUrl' => $this->getRequest()->getUri(),
        			'historyEntity' => $entity
        		));

        		$this->flashmessenger()->addSuccessMessage('Object was deleted');

        		return $this->redirect()->toRoute('history-index');
        	}

        	return $this->redirect()->toRoute('history-view', array('id' => $id));
        }

        return new ViewModel(array(
        	'entity' => $entity
        ));
    }


}

