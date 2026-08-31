<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractEntity implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    final protected int $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    final protected ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    final protected ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    final protected ?User $createdBy = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    final protected ?User $updatedBy = null;

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    final public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    final public function setCreatedAtValue(): static
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    final public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    final public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PreUpdate]
    final public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    final public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    final public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    final public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    final public function setUpdatedBy(?User $updatedBy): static
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
