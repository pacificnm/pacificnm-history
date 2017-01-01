<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Mapper;

use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\AbstractMysqlMapper;
use Pacificnm\History\Entity\Entity;

class MysqlMapper extends AbstractMysqlMapper implements MysqlMapperInterface
{

    /**
     * Mysql Mapper Construct
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param Entity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, Entity $prototype)
    {
        $this->hydrator = $hydrator;
            
        $this->prototype = $prototype;
            
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     * {@inheritdoc}
     *
     * @see \History\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll(array $filter)
    {
        $this->select = $this->readSql->select('history');
                    
        $this->joinAuth()->joinAclRole();
        
        $this->filter($filter); 

        if (array_key_exists('pagination', $filter)) {
            if ($filter['pagination'] == 'off') {  
                return $this->getRows();    
            }
        }

        return $this->getPaginator();
    }

    /**
     * {@inheritdoc}
     *
     * @see \History\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('history');

        $this->joinAuth()->joinAclRole();
        
        $this->select->where(array(
            'history.history_id = ?' => $id  
        ));
                    
        return $this->getRow();
    }

    /**
     * {@inheritdoc}
     *
     * @see \History\Mapper\MysqlMapperInterface::save()
     */
    public function save(Entity $entity)
    {
        $postData = $this->hydrator->extract($entity);
                    
        if ($entity->getHistoryId()) {
            $this->update = new Update('history'); 
                
            $this->update->set($postData);  
                
            $this->update->where(array(
                'history.history_id = ?' => $entity->getHistoryId()
            ));
                    
            $this->updateRow();            
        } else {
            $this->insert = new Insert('history'); 
                
            $this->insert->values($postData);
                
            $id = $this->createRow();
                
            $entity->setHistoryId($id);        
        }
                    
        return $this->get($entity->getHistoryId());
    }

    /**
     * {@inheritdoc}
     *
     * @see \History\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(Entity $entity)
    {
        $this->delete = new Delete('history');
        $this->delete->where(array(
             'history.history_id = ?' => $entity->getHistoryId()
        ));
                 
        return $this->deleteRow();
    }

    /**
     * Filters and search
     *
     * @param array $filter
     * @return \History\Mapper\MysqlMapper
     */
    protected function filter(array $filter)
    {
        // email
        if(array_key_exists('authEmail', $filter) && strlen($filter['authEmail']) > 0) {
            $this->select->where->like('auth.auth_email', $filter['authEmail'] . '%');
        }
        
        return $this;
    }

    /**
     * 
     * @return \History\Mapper\MysqlMapper
     */
    protected function joinAuth()
    {
        $this->select->join('auth', 'history.auth_id = auth.auth_id', array(
            'auth_email',
            'auth_name',
            'acl_role_id'
        ), 'left');
        
        return $this;
    }
    
    /**
     * 
     * @return \History\Mapper\MysqlMapper
     */
    protected function joinAclRole()
    {
        $this->select->join('acl_role', 'auth.acl_role_id = acl_role.acl_role_id', array(
            'acl_role_name'
        ), 'left');
        
        return $this;
    }

}

