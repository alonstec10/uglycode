<?php

namespace App\Library\Entities\Stocks;

use App\Library\Client\Polygon\Client;
use App\Library\Entities\BaseEntity;
use App\Library\Entities\Entity;
use App\Library\Mapper\Mapper;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;



class All extends BaseEntity implements Entity
{
    const QUERY = '/v3/reference/tickers';
    private array $filters = [
        'active=true',
        'limit=1000',
    ];

    /**
     * @var Manager $manager
     */
    private Manager $manager;

    /**
     * @param Mapper $mapper
     * @param array $params
     * @param string $cursor
     * @return All
     * @throws Exception
     */
    public function __construct( Mapper $mapper, array $params, string $cursor = '' )
    {
        $this->setParams($params);
        $this->setMapper($mapper);

        $url =  self::QUERY . '?' . implode("&", array_merge($this->filters, $this->extractCursor($cursor)));

        $client = new Client($url, $this->getMapper()->map($this->getParams()), 'GET');
        $this->setClient($client);

        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer());
        $this->manager = $manager;
        return $this;
    }

    /**
     * @throws GuzzleException
     */
    public function exec(): array
    {
        return json_decode($this->getClient()->execute()->getRawResponse(), true);
    }

    /**
     * @param string $cursor
     * @return array
     */
    private function extractCursor( string $cursor ): array
    {
        return [substr($cursor, strpos($cursor, "?") + 1, strlen($cursor))];
    }

}