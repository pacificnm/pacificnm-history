<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pacificnm-history for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license BSD-3-Clause
 */
namespace Pacificnm\History\Entity;

class Entity
{

    /**
     *
     * @var number
     */
    protected $historyId;

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var string
     */
    protected $historyRequest;

    /**
     *
     * @var string
     */
    protected $historyRequestType;

    /**
     *
     * @var number
     */
    protected $historyRequestTime;

    /**
     *
     * @var string
     */
    protected $historyRequestParams;

    /**
     *
     * @var string
     */
    protected $historyRemoteAddress;

    /**
     *
     * @var string
     */
    protected $historyRemoteBrowser;

    /**
     *
     * @var \Pacificnm\Auth\Entity\Entity
     */
    protected $authEntity;

    /**
     *
     * @return the $historyId
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }

    /**
     *
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $historyRequest
     */
    public function getHistoryRequest()
    {
        return $this->historyRequest;
    }

    /**
     *
     * @return the $historyRequestType
     */
    public function getHistoryRequestType()
    {
        return $this->historyRequestType;
    }

    /**
     *
     * @return the $historyRequestTime
     */
    public function getHistoryRequestTime()
    {
        return $this->historyRequestTime;
    }

    /**
     *
     * @return the $historyRequestParams
     */
    public function getHistoryRequestParams()
    {
        return $this->historyRequestParams;
    }

    /**
     *
     * @return the $historyRemoteAddress
     */
    public function getHistoryRemoteAddress()
    {
        return $this->historyRemoteAddress;
    }

    /**
     *
     * @return the $historyRemoteBrowser
     */
    public function getHistoryRemoteBrowser()
    {
        return $this->historyRemoteBrowser;
    }

    /**
     *
     * @return the $authEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
    }

    /**
     *
     * @param number $historyId            
     */
    public function setHistoryId($historyId)
    {
        $this->historyId = $historyId;
    }

    /**
     *
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param string $historyRequest            
     */
    public function setHistoryRequest($historyRequest)
    {
        $this->historyRequest = $historyRequest;
    }

    /**
     *
     * @param string $historyRequestType            
     */
    public function setHistoryRequestType($historyRequestType)
    {
        $this->historyRequestType = $historyRequestType;
    }

    /**
     *
     * @param number $historyRequestTime            
     */
    public function setHistoryRequestTime($historyRequestTime)
    {
        $this->historyRequestTime = $historyRequestTime;
    }

    /**
     *
     * @param string $historyRequestParams            
     */
    public function setHistoryRequestParams($historyRequestParams)
    {
        $this->historyRequestParams = $historyRequestParams;
    }

    /**
     *
     * @param string $historyRemoteAddress            
     */
    public function setHistoryRemoteAddress($historyRemoteAddress)
    {
        $this->historyRemoteAddress = $historyRemoteAddress;
    }

    /**
     *
     * @param string $historyRemoteBrowser            
     */
    public function setHistoryRemoteBrowser($historyRemoteBrowser)
    {
        $this->historyRemoteBrowser = $historyRemoteBrowser;
    }

    /**
     *
     * @param \Auth\Entity\Entity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }
}

