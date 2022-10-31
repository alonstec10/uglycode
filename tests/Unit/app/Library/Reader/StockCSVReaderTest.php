<?php

namespace Tests\Unit\App\Library\Reader;

use App\Library\Reader\Csv;
use App\Library\Reader\Reader;
use Tests\TestCase;

class StockCSVReaderTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_isInstanceOf()
    {
        $this->assertInstanceOf(Reader::class, $this->returnReader());
    }

    public function test_doesFileLocationExist()
    {
        $reader = $this->returnReader();
        $this->assertNotEmpty($reader->getFileLocation());
    }

    public function test_returnsJson()
    {
        $reader = $this->returnReader();

        $this->assertJson($reader->read());
    }

    private function returnReader() : Reader
    {
        $files = glob( config('filesystems.disks.files.root') . '/*.csv');
        $file = end($files);

        return new Csv($file);
    }

}