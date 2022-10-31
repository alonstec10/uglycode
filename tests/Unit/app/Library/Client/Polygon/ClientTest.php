<?php

namespace Tests\Unit\App\Library\Client\Polygon;

use App\Library\Client\Polygon\Client;
use Exception;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @throws Exception
     * @dataProvider clientData
     */
    public function test_PolygonClientHasHeaders( $query, $params )
    {
        $client = new Client( $query, $params);
        $this->assertIsArray($client->getHeaders());
        $this->assertArrayHasKey('Authorization', $client->getHeaders());
    }

    /**
     * @throws Exception
     * @dataProvider clientData
     */
    public function test_clientHasClient( $query, $params )
    {
        $client = new Client( $query, $params);
        $this->assertNotEmpty($client->getClient());
        $this->assertInstanceOf(\GuzzleHttp\Client::class, $client->getClient());
    }

    /**
     * @throws Exception
     * @dataProvider clientData
     */
    public function test_queryIsSet( $query, $params )
    {
        $client = new Client( $query, $params);
        $this->assertNotEmpty($client->getQuery());
    }

    public function clientData(): array
    {
        return [
            [
                "query" => '/v3/reference/tickers',
                "params" => [],
            ]
        ];
    }

}
