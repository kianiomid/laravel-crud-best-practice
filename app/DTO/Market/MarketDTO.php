<?php

namespace App\DTO\Market;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class MarketDTO extends DataTransferObject
{
    /**
     * @var int|null
     */
    #[MapFrom('id')]
    #[MapTo('id')]
    public ?int $id;

    /**
     * @var string
     */
    #[MapFrom('title')]
    #[MapTo('title')]
    public string $title;

    /**
     * @var string
     */
    #[MapFrom('name')]
    #[MapTo('name')]
    public string $name;

    /**
     * @var string
     */
    #[MapFrom('description')]
    #[MapTo('description')]
    public string $description;

    /**
     * @var bool
     */
    #[MapFrom('enabled')]
    #[MapTo('enabled')]
    public bool $enabled;

    /**
     * @var string|null
     */
    #[MapFrom('created_at')]
    #[MapTo('created_at')]
    public ?string $createdAt;

    /**
     * @var string|null
     */
    #[MapFrom('updated_at')]
    #[MapTo('updated_at')]
    public ?string $updatedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return MarketDTO
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return MarketDTO
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return MarketDTO
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return MarketDTO
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return MarketDTO
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return MarketDTO
     */
    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return MarketDTO
     */
    public function setUpdatedAt(?string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}
