<?php

namespace App\Library\Writer;

use JetBrains\PhpStorm\Pure;

class Csv implements Writer
{
    /**
     * Csv location of the file to be written
     * @var string $fileLocation
     */
    private string $fileLocation;

    /**
     * @var array $data
     */
    private array $data;

    /**
     * @var mixed
     */
    private mixed $resource;

    /**
     * @var mixed $preWrite
     */
    private mixed $preWrite;


    /**
     * @param string $fileLocation
     */
    public function __construct( string $fileLocation )
    {
        $this->setFileLocation($fileLocation);
        if(!$this->fileExists()) $this->createFile();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function write( array $data ): bool
    {
        $this->setData($data);

        $this->openResource();

        if( !empty($this->preWrite) ) {
            $this->preWrite->__invoke($this);
        }

        foreach( $data as $line ) {
            $this->writeLine($line);
        }

        $this->closeResource();
        return true;
    }


    public function writeLine( array $data )
    {
        if(empty($this->getResource())) {
            $this->openResource();
        }
        fwrite($this->getResource(), implode("|", array_values($data)) . "\n" );
    }

    /**
     * @param string $fileLocation
     */
    public function setFileLocation(string $fileLocation): void
    {
        $this->fileLocation = $fileLocation;
    }

    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    private function fileExists(): bool
    {
        return file_exists($this->getFileLocation());
    }

    /**
     * @return mixed
     */
    public function getResource(): mixed
    {
        return $this->resource;
    }

    /**
     * @param mixed $resource
     */
    public function setResource(mixed $resource): void
    {
        $this->resource = $resource;
    }

    private function closeResource()
    {
        fclose($this->getResource());
    }

    private function openResource()
    {
        $this->setResource(fopen($this->getFileLocation(), 'a+'));
    }

    private function createFile()
    {
        $this->openResource();
        $this->closeResource();
    }

    public function setPreWrite($func)
    {
        $this->preWrite = $func;
    }

}