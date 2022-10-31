<?php

namespace Tests\Unit\App\Library\Entities\Stocks;

use App\Library\Entities\Entity;
use App\Library\Entities\Stocks\All;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;
use Mockery\MockInterface;
use App\Library\Mapper\Polygon\Stocks\All as AllMapper;

class AllTest extends \Tests\TestCase
{

    /**
     * @var All $instance
     */
    private All $instance;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $mapper = Mockery::mock(AllMapper::class, function ( MockInterface $mock ) {});
        $mapper->shouldReceive('map')->andReturn([]);
        $this->instance = new All($mapper, []);
    }

    public function test_instance()
    {
        $this->assertInstanceOf(Entity::class, $this->instance);
    }

    public function test_paramsAreNullForAll()
    {
        $this->assertEmpty($this->instance->getParams());
    }

    /**
     * @throws GuzzleException
     */
    public function test_getAllStocks()
    {
        $data = $this->instance->exec();
        $this->assertArrayHasKey('results', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('count', $data);
        $this->assertArrayHasKey('next_url', $data);
    }

}