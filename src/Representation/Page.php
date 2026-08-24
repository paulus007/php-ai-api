<?php

namespace App\Representation;

use JsonSerializable;

final readonly class Page implements JsonSerializable
{
    public function __construct(
        /** array<JsonSerializable> */
        private array $records,
        private int $totalRecords,
        private int $offset,
        private int $limit
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'records' => $this->records,
            'totalRecords' => $this->totalRecords,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ];
    }
}
