<?php

namespace Tests\Unit\App\Library\Entities\Exchanges;

use App\Library\Entities\Entity;
use App\Library\Entities\Exchange\All;
use Tests\TestCase;

class AllTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_instanceClientInstance()
    {
        $this->assertInstanceOf(Entity::class, $this->getClient());
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_getExchanges()
    {
        $data = $this->getClient()->exec();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('results', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('count', $data);
    }

    public function test_getNewYorkStockExchange()
    {
        $data = $this->getClient()->exec();

        $names = [];
        foreach( $data['results'] as $exchange) {
            $names[] = $exchange['name'];
        }
        $this->assertTrue(in_array('NYSE American, LLC', $names));
    }

    /**
     * @return \App\Library\Entities\Exchange\All
     */
    private function getClient(): All
    {
        return new All();
    }

}