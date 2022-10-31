<?php

namespace App\Library\Reader;

/**
 * This CSV file returns the data into json
 */
class Csv implements Reader
{

    /**
     * @var string $fileLocation
     */
    private string $fileLocation;

    /**
     * @var array
     */
    private array $data;

    /**
     * @var mixed
     */
    private mixed $resource;


    /**
     * @param string $fileLocation
     */
    public function __construct(string $fileLocation)
    {
        $this->setFileLocation($fileLocation);
        $this->setResource(fopen($this->getFileLocation(), 'r'));
    }

    public function read(): string
    {
        $stockData = [];
        //read first file line to get headers
        $headers = $this->getCSVHeaders();
        //dont get the headers
        fseek($this->getResource(), 0, 1);
        while( ($buffer = fgets($this->getResource(), 4096)) !== false  )
        {
            $bufferParts = explode("|", $buffer);
            $stock = [];
            foreach( $bufferParts as $key => $value) {
                try {

                    $column = trim($headers[$key]);
                    $stock[$column] = trim($value);
                } catch (\Exception $e ) {

                }

            }
            $stockData[] = $stock;
        }
        fclose($this->getResource());
        return json_encode($stockData);
    }

    private function getCSVHeaders(): array
    {
        fseek($this->getResource(), 0);
        return explode("|", fgets($this->getResource(), 4096));
    }

    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    public function setFileLocation(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $params)
    {
        $this->data = $params;
    }

    public function getResource(): mixed
    {
        return $this->resource;
    }

    public function setResource($resource)
    {
        return $this->resource = $resource;
    }
}