<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
#[ORM\Table(name: '`providers`')]
#[ORM\UniqueConstraint(name: 'name_uniq_idx', fields: ['name'])]
final class Provider extends AbstractEntity
{
    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 50, unique: true, nullable: false)]
        private string $name,
        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        private string $description,
        #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
        private string $url,
        #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
        private bool $active = false,
        #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
        private bool $rfResident = false,
        #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => false])]
        private bool $needProxy = false,
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isRfResident(): bool
    {
        return $this->rfResident;
    }

    public function setRfResident(bool $rfResident): self
    {
        $this->rfResident = $rfResident;

        return $this;
    }

    public function isNeedProxy(): bool
    {
        return $this->needProxy;
    }

    public function setNeedProxy(bool $needProxy): self
    {
        $this->needProxy = $needProxy;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'active' => $this->active,
            'rfResident' => $this->rfResident,
            'needProxy' => $this->needProxy,
        ];
    }
}
