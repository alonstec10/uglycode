<?php

namespace App\Library\Reader;

interface Reader
{
    /**
     * @param string $fileLocation
     */
    public function __construct( string $fileLocation );

    /**
     * @return string
     */
    public function read(): string;

    /**
     * @return string
     */
    public function getFileLocation(): string;

    /**
     * @param string $fileLocation
     */
    public function setFileLocation( string $fileLocation );

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param array $params
     */
    public function setData( array $params );

    /**
     * @return mixed
     */
    public function getResource(): mixed;

    /**
     * @param $resource
     */
    public function setResource( $resource );

}