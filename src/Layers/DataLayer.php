<?php

namespace App\Layers;

use App\Entity\AbstractEntity;

final class DataLayer extends AbstractLayer
{
    public function siftOut(?AbstractEntity $entity): ?AbstractEntity
    {
        return $entity;
    }
}
