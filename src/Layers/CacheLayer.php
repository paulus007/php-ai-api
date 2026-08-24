<?php

namespace App\Layers;

use Entity\RestEntity;

final class CacheLayer extends AbstractLayer
{
    private static array $cacheMatrix = [];

    public function siftOut(?RestEntity $entity): ?RestEntity
    {
        return $entity;
    }
}
