<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Service;

use Pacificnm\History\Entity\Entity;
use Pacificnm\History\Mapper\MysqlMapperInterface;

class Service implements ServiceInterface
{
    /**
     * 
     * @var MysqlMapperInterface
     */
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
     * @see \Pacificnm\History\Service\ServiceInterface::getAll()
     */
    public function getAll(array $filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * {@inheritDoc}
     *
     * @see \Pacificnm\History\Service\ServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * {@inheritDoc}
     *
     * @see \Pacificnm\History\Service\ServiceInterface::save()
     */
    public function save(Entity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * {@inheritDoc}
     *
     * @see \Pacificnm\History\Service\ServiceInterface::delete()
     */
    public function delete(Entity $entity)
    {
        return $this->mapper->delete($entity);
    }


}

