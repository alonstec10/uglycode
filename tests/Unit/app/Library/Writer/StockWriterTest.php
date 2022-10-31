<?php

namespace Tests\Unit\App\Library\Writer;

use App\Library\Writer\Csv;
use App\Library\Writer\Writer;
use Tests\TestCase;

class StockWriterTest extends TestCase
{

    private string $testingFile;

    public function setUp(): void
    {
        parent::setUp();
        $this->testingFile = '';
    }

    public function test_InstanceOfWriter()
    {
        $this->assertInstanceOf(Writer::class, $this->getFileWriter());
    }

    public function test_fileLocationExistsIfNotCreate()
    {
        $writer = $this->getFileWriter();
        $this->assertFileExists($writer->getFileLocation());
    }

    public function test_fileLocationIsWritable()
    {
        $writer = $this->getFileWriter();
        $this->assertFileIsWritable($writer->getFileLocation());
    }

    public function test_writeFailed()
    {
        $filePath = '/fake_file_path' . now() . '.csv';
        try {
            $csv = new Csv($filePath);
        } catch (\Exception $e ) {}
        $this->assertFileDoesNotExist($filePath);
    }

    /**
     * @param array $data
     * @dataProvider fileData
     */
    public function test_writeSucceeded( array $data )
    {

        $writer = $this->getFileWriter();

        $data = $data['data'];

        $this->assertTrue($writer->write($data));

    }

    /**
     * @dataProvider fileData
     */
    public function test_FileIsCsv( array $data )
    {
        $writer = $this->getFileWriter();

        $data = $data['data'];

        $this->assertTrue($writer->write($data));

        $pathInfo = pathinfo($writer->getFileLocation());

        $this->assertEquals('csv', $pathInfo['extension']);
    }

    /**
     * @dataProvider fileData
     */
    public function test_headersWithPreWrite( array $data )
    {
        $writer = $this->getFileWriter();
        //this is a hook
        $writer->setPreWrite(function( $currentWriter ) {
            $keys = array_keys(current($currentWriter->getData()));
            $currentWriter->writeLine($keys);
        });
        $data = $data['data'];

        $this->assertTrue($writer->write($data));
    }


    public function tearDown(): void
    {
        if(file_exists($this->testingFile)) unlink($this->testingFile);

        parent::tearDown();
    }

    /**
     * @return Csv
     */
    protected function getFileWriter(): Csv
    {
        $filePath = config('filesystems.disks.files.root') . '/' . now() . '.csv';
        $this->testingFile = $filePath;
        return new Csv($filePath);
    }

    public function fileData(): array
    {
        return [
            [
                [ 'data' =>
                    [
                        ['test' => 1, 'hyper' => 'testing1', 'name' => 'another one'],
                        ['test' => 2, 'hyper' => 'testing2', 'name' => 'another one two'],
                        ['test' => 3, 'hyper' => 'testing3', 'name' => 'another one three'],
                        ['test' => 4, 'hyper' => 'testing4', 'name' => 'another one four'],
                    ]
                ]
            ]
        ];
    }



}