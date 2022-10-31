<?php

namespace App\Library\Mapper;

interface Mapper
{
    public function map( array $params = []): array;
}
