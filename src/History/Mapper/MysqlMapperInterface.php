<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Mapper;

use History\Entity\Entity;

interface MysqlMapperInterface
{

    /**
     * @param array $filter
     * @return Paginator
     */
    public function getAll(array $filter);
    /**
     * @param number $id
     * @return Entity
     */
    public function get($id);
    /**
     * @param Entity $entity
     * @return Entity
     */
    public function save(Entity $entity);
    /**
     * @param Entity $entity
     * @return Boolean
     */
    public function delete(Entity $entity);

}

