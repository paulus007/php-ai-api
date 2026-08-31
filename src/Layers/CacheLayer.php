<?php

namespace App\Layers;

use App\Entity\AbstractEntity;

final class CacheLayer extends AbstractLayer
{
    public function siftOut(?AbstractEntity $entity): ?AbstractEntity
    {
        return $entity;
    }
}
