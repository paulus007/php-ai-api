<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
#[ORM\Table(name: '`template`')]
final class Template extends AbstractEntity
{
    public function __construct(
        #[ORM\Column(type: 'string', length: 255, unique: true)]
        private string $name,
        #[ORM\ManyToMany(targetEntity: TemplatePart::class, inversedBy: 'template_part')]
        private Collection $parts = new ArrayCollection([]),
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getParts(): ArrayCollection
    {
        return $this->parts;
    }

    public function setParts(ArrayCollection $parts): self
    {
        $this->parts = $parts;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parts' => array_map(
                static fn (TemplatePart $part): array => $part->jsonSerialize(),
                $this->parts->toArray()
            ),
        ];
    }
}
