<?php

namespace App\Layers;

use Entity\RestEntity;

abstract class AbstractLayer
{
    abstract public function siftOut(?RestEntity $entity): ?RestEntity;
}
