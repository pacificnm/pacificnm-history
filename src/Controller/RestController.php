<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Pacificnm\History\Service\ServiceInterface;

class RestController extends AbstractRestfulController
{

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
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
     */
    public function create($data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
     */
    public function delete($id)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::deleteList()
     */
    public function deleteList($data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
     */
    public function get($id)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
     */
    public function getList($params)
    {
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('countPerPage', 25);
        
        $filter = array();
        
        $entitys = $this->service->getAll($filter);
        
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        $data = array();
        
        foreach ($paginator as $entity) {
            if ($entity->getAuthId() > 0) {
                $authEmail = $entity->getAuthEntity()->getAuthEmail();
            } else {
                $authEmail = 'Guest';
            }
            $data[] = array(
                'historyId' => $entity->getHistoryId(),
                'authId' => $entity->getAuthId(),
                'authEmail' => $authEmail,
                'historyRequest' => $entity->getHistoryRequest(),
                'historyRequestType' => $entity->getHistoryRequestType(),
                'historyRequestTime' => date('m/d/y h:i A', $entity->getHistoryRequestTime()),
                'historyRemoteAddress' => $entity->getHistoryRemoteAddress(),
                'historyRemoteBrowser' => $entity->getHistoryRemoteBrowser()
            );
        }
        
        return new JsonModel(array(
            'content' => $data,
            'page' => $page,
            'countPerPage' => $countPerPage,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count()
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::head()
     */
    public function head($id)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::options()
     */
    public function options()
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::patch()
     */
    public function patch($id, $data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::replaceList()
     */
    public function replaceList($data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::patchList()
     */
    public function patchList($data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
     */
    public function update($id, $data)
    {
        $this->response->setStatusCode(405);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractRestfulController::notFoundAction()
     */
    public function notFoundAction()
    {
        $this->response->setStatusCode(404);
        return new JsonModel(array(
            "content" => "Method Not Allowed"
        ));
    }
}

