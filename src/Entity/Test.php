<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'test')]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $name = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
