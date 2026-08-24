<?php

namespace App\Repository;

abstract readonly class AbstractRepository
{
    protected const int DEFAULT_OFFSET = 0;
    protected const int DEFAULT_LIMIT = 5;
}
