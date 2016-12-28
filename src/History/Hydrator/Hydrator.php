<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace History\Hydrator;

use Zend\Hydrator\ClassMethods;
use History\Entity\Entity;

class Hydrator extends ClassMethods
{

    /**
     * @param string $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
                
        parent::hydrate($data, $object);
               
        $authEntity = parent::hydrate($data, new \Auth\Entity\Entity());
        
        $object->setAuthEntity($authEntity);
        
        $aclRoleEntity = parent::hydrate($data, new \AclRole\Entity\Entity());
        
        $object->getAuthEntity()->setAclRoleEntity($aclRoleEntity);
        
        return $object;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
                    
        $data = parent::extract($object);
               
        unset($data['auth_entity']);
                    
        return $data;
    }


}

