<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`users`')]
final class User implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
