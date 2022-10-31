<?php

namespace Tests\Unit\App\Library\Mapper\Polygon;

use App\Library\Mapper\Mapper;
use App\Library\Mapper\Polygon\Stocks\All;
use Tests\TestCase;

class AllTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param string $class
     * @dataProvider Mappers
     */
    public function test_instantiation_mapper( string $class, array $data )
    {
        $mapper = new $class;
        $this->assertInstanceOf(Mapper::class, $mapper);
        $this->assertEquals($data, $mapper->map([]));
    }

    /**
     * DataProvider for all the mappers
     * @return array
     */
    public function Mappers(): array
    {
        return [
            [
                'class' => All::class,
                'data' => []
            ]
        ];
    }

}
