<?php

namespace App\Library\Writer;

interface Writer
{

    /**
     * @param string $fileLocation
     */
    public function __construct( string $fileLocation );

    /**
     * @param array $data
     * @return bool
     */
    public function write( array $data ): bool;

    /**
     * @return string
     */
    public function getFileLocation(): string;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param array $data
     */
    public function setData( array $data );


    /**
     * @param $func
     */
    public function setPreWrite( $func );

    /**
     * @param array $data
     */
    public function writeLine( array $data );

}