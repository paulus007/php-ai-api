<?php

namespace App\Entity;

use App\Entity\TemplatePartProperty\EnumType;
use App\Repository\TemplatePartPropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplatePartPropertyRepository::class)]
#[ORM\Table(name: '`template_part_property`')]
final class TemplatePartProperty extends AbstractEntity
{
    public function __construct(
        #[ORM\ManyToOne(targetEntity: TemplatePart::class)]
        #[ORM\JoinColumn(name: 'template_part_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
        private TemplatePart $templatePart,
        #[ORM\Column(name: 'name', type: Types::STRING, length: 255, nullable: false)]
        private string $name,
        #[ORM\Column(length: 255, nullable: false, enumType: EnumType::class)]
        private EnumType $type,
        #[ORM\ManyToMany(targetEntity: TemplatePartPropertyValue::class, inversedBy: 'template_part_property_value')]
        private Collection $values = new ArrayCollection([]),
    ) {}

    public function getTemplatePart(): TemplatePart
    {
        return $this->templatePart;
    }

    public function setTemplatePart(TemplatePart $templatePart): self
    {
        $this->templatePart = $templatePart;

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

    public function getType(): EnumType
    {
        return $this->type;
    }

    public function setType(EnumType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getValues(): ArrayCollection
    {
        return $this->values;
    }

    public function setValues(ArrayCollection $values): self
    {
        $this->values = $values;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type->value,
            'values' => array_map(
                static fn (TemplatePartPropertyValue $value): array => $value->jsonSerialize(),
                $this->values->toArray()
            ),
        ];
    }
}
