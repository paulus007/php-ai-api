<?php

namespace App\Entity;

use App\Repository\TemplatePartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplatePartRepository::class)]
#[ORM\Table(name: '`template_part`')]
final class TemplatePart extends AbstractEntity
{
    public function __construct(
        #[ORM\ManyToOne(targetEntity: Template::class, inversedBy: 'templateParts')]
        #[ORM\JoinColumn(name: 'template_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
        private Template $template,
        #[ORM\Column(name: 'name', type: Types::STRING, length: 255, nullable: false)]
        private string $name,
        #[ORM\OneToMany(targetEntity: TemplatePartProperty::class, mappedBy: 'templatePart', cascade: ['persist', 'remove'], orphanRemoval: true,)]
        private Collection $templatePartProperties = new ArrayCollection([])
    ) {}

    public function getTemplate(): Template
    {
        return $this->template;
    }

    public function setTemplate(Template $template): self
    {
        $this->template = $template;

        return $this;
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

    public function getTemplatePartProperties(): ArrayCollection
    {
        return $this->templatePartProperties;
    }

    public function setTemplatePartProperties(ArrayCollection $templatePartProperties): self
    {
        $this->templatePartProperties = $templatePartProperties;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'properties' => array_map(
                static fn (TemplatePartProperty $property): array => $property->jsonSerialize(),
                $this->templatePartProperties->toArray()
            ),
        ];
    }
}
