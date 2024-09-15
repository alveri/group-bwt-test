<?php

namespace App\Input;

class FileInputParser implements InputParserInterface
{
    /**
     * @param string $input
     *
     * @return array<AmountDto>
     */
    public function parse(string $input): array
    {
        $amountsData = [];
        foreach (explode("\n", file_get_contents('./'. $input)) as $row) {
            $data = json_decode($row, true);
            $amountsData[] = new AmountDto($data['amount'], $data['currency'], $data['bin']);

        }

        return $amountsData;
    }
}