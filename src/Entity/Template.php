<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
#[ORM\Table(name: '`template`')]
final class Template extends AbstractEntity
{
    public function __construct(
        #[ORM\Column(type: 'string', length: 255, unique: true)]
        private string $name,
        #[ORM\OneToMany(targetEntity: TemplatePart::class, mappedBy: 'template', cascade: ['persist', 'remove'], orphanRemoval: true, )]
        private Collection $templateParts = new ArrayCollection([]),
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplateParts(): ArrayCollection
    {
        return $this->templateParts;
    }

    public function setTemplateParts(ArrayCollection $templateParts): self
    {
        $this->templateParts = $templateParts;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parts' => array_map(
                static fn (TemplatePart $part): array => $part->jsonSerialize(),
                $this->templateParts->toArray()
            ),
        ];
    }
}
