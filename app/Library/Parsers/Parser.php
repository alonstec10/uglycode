<?php

namespace App\Library\Parsers;

interface Parser
{
    /**
     * @return array
     */
    public function parse(): array;
}