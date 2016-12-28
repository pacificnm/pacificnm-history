<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Service;

use History\Entity\Entity;
use History\Mapper\MysqlMapperInterface;

class Service implements ServiceInterface
{

    protected $mapper = null;

    /**
     * Service Construct
     *
     * @param MysqlMapperInterface $mapper
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * {@inheritDoc}
     *
     * @see \History\Service\ServiceInterface::getAll()
     */
    public function getAll(array $filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * {@inheritDoc}
     *
     * @see \History\Service\ServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * {@inheritDoc}
     *
     * @see \History\Service\ServiceInterface::save()
     */
    public function save(Entity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * {@inheritDoc}
     *
     * @see \History\Service\ServiceInterface::delete()
     */
    public function delete(Entity $entity)
    {
        return $this->mapper->delete($entity);
    }


}

