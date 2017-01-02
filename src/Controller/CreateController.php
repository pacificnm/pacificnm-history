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
use Pacificnm\Application\Controller\AbstractApplicationController;
use Pacificnm\History\Service\ServiceInterface;
use Pacificnm\History\Form\Form;

class CreateController extends AbstractApplicationController
{

    protected $service = null;

    protected $form = null;

    /**
     * @param ServiceInterface $service
     * @param Form $form
     */
    public function __construct(ServiceInterface $service, Form $form)
    {
        $this->service = $service;

        $this->form = $form;
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
        
        $request = $this->getRequest();

        if ($request->isPost()) {
        	$postData = $request->getPost();

        	$this->form->setData($postData);

        	if ($this->form->isValid()) {
        		$entity = $this->form->getData();

        		$historyEntity = $this->service->save($entity);

        		$this->getEventManager()->trigger('historyCreate', $this, array(
        			'authId' => $this->identity()->getAuthId(),
        			'requestUrl' => $this->getRequest()->getUri(),
        			'historyEntity' => $entity
        		));

        		$this->flashMessenger()->addSuccessMessage('Object was saved');

        		return $this->redirect()->toRoute('history-view', array(
        			'id' => $historyEntity->getHistoryId()
        		));
        	}
        }

        return new ViewModel(array(
        	'form' => $this->form
        ));
    }


}

