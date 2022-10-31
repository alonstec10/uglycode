<?php

namespace App\Library\Entities;

use App\Library\Client\Polygon\Client;
use App\Library\Mapper\Mapper;

abstract class BaseEntity
{
    /**
     * @var array $params
     */
    public array $params;

    /**
     * @var Mapper $mapper
     */
    public Mapper $mapper;

    /**
     * @var Client $client
     */
    public Client $client;

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return Mapper
     */
    public function getMapper(): Mapper
    {
        return $this->mapper;
    }

    /**
     * @param Mapper $mapper
     */
    public function setMapper(Mapper $mapper): void
    {
        $this->mapper = $mapper;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

}