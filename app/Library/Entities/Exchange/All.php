<?php

namespace App\Library\Entities\Exchange;

use App\Library\Client\Polygon\Client;
use App\Library\Entities\BaseEntity;
use App\Library\Entities\Entity;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class All extends BaseEntity implements Entity
{
    /**
     * @var string $url
     */
    private string $url = '/v3/reference/exchanges';

    /**
     * @var Manager $manager
     */
    private Manager $manager;


    /**
     * @throws \Exception
     */
    public function __construct( )
    {
        $client = new Client($this->getUrl(), [], 'GET');
        $this->setClient($client);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $this->manager = $manager;
        return $this;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exec(): array
    {
        return json_decode($this->getClient()->execute()->getRawResponse(), true);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return \League\Fractal\Manager
     */
    public function getManager(): Manager
    {
        return $this->manager;
    }

    /**
     * @param \League\Fractal\Manager $manager
     */
    public function setManager(Manager $manager): void
    {
        $this->manager = $manager;
    }


}