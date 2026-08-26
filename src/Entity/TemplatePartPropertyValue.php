<?php

namespace App\Entity;

use App\Repository\TemplatePartPropertyValueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplatePartPropertyValueRepository::class)]
#[ORM\Table(name: '`template_part_property_value`')]
class TemplatePartPropertyValue extends AbstractEntity
{
    public function __construct(
        #[ORM\ManyToOne(targetEntity: TemplatePartProperty::class, inversedBy: 'templatePartPropertyValues')]
        #[ORM\JoinColumn(name: 'template_part_property_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
        private TemplatePartProperty $templatePartProperty,
        #[ORM\Column(name: 'int', type: Types::INTEGER, nullable: true)]
        private ?int $int,
        #[ORM\Column(name: 'float', type: Types::FLOAT, nullable: true)]
        private ?float $float,
        #[ORM\Column(name: 'string', type: Types::STRING, nullable: true)]
        private ?string $string,
        #[ORM\Column(name: 'boolean', type: Types::BOOLEAN, nullable: true)]
        private ?bool $bool,
        #[ORM\Column(name: 'json', type: Types::JSON, nullable: true)]
        private ?array $array
    ) {}

    public function getTemplatePartProperty(): TemplatePartProperty
    {
        return $this->templatePartProperty;
    }

    public function setTemplatePartProperty(TemplatePartProperty $templatePart): self
    {
        $this->templatePartProperty = $templatePart;

        return $this;
    }

    public function getInt(): ?int
    {
        return $this->int;
    }

    public function setInt(?int $int): self
    {
        $this->int = $int;

        return $this;
    }

    public function getFloat(): ?float
    {
        return $this->float;
    }

    public function setFloat(?float $float): self
    {
        $this->float = $float;

        return $this;
    }

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(?string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getBool(): ?bool
    {
        return $this->bool;
    }

    public function setBool(?bool $bool): self
    {
        $this->bool = $bool;

        return $this;
    }

    public function getArray(): ?array
    {
        return $this->array;
    }

    public function setArray(?array $array): self
    {
        $this->array = $array;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'int' => $this->int,
            'float' => $this->float,
            'string' => $this->string,
            'bool' => $this->bool,
            'array' => $this->array,
        ];
    }
}
