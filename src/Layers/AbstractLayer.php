<?php

namespace App\Layers;

use App\Entity\AbstractEntity;

abstract class AbstractLayer
{
    abstract public function siftOut(?AbstractEntity $entity): ?AbstractEntity;
}
