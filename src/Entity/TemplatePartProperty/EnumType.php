<?php

namespace App\Entity\TemplatePartProperty;

enum EnumType: string
{
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case STRING = 'string';
    case BOOLEAN = 'boolean';
    case ARRAY = 'array';
}
