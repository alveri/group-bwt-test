<?php

namespace App\Input;

interface InputParserInterface
{
    public function parse(string $input): array;
}