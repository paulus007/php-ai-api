<?php

namespace App\Layers;

use Entity\RestEntity;

final class DataLayer extends AbstractLayer
{
    public function siftOut(?RestEntity $entity): ?RestEntity
    {
        return $entity;
    }
}
