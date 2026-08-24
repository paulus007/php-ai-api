<?php

namespace App\Layers;

use Entity\RestEntity;

final class SecurityLayer extends AbstractLayer
{
    public function siftOut(?RestEntity $entity): ?RestEntity
    {
        return $entity;
    }
}
