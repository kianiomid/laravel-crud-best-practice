<?php

namespace App\DTO\Base;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PaginationDTO extends DataTransferObject
{
    /**
     * @var string|null
     */
    #[MapFrom('first_page_url')]
    #[MapTo('first')]
    public ?string $first;
    /**
     * @var string|null
     */
    #[MapFrom('last_page_url')]
    #[MapTo('last')]
    public ?string $last;
    /**
     * @var string|null
     */
    #[MapFrom('prev_page_url')]
    #[MapTo('prev')]
    public ?string $prev;
    /**
     * @var string|null
     */
    #[MapFrom('next_page_url')]
    #[MapTo('next')]
    public ?string $next;
    /**
     * @var int|null
     */
    #[MapFrom('per_page')]
    #[MapTo('per_page')]
    public ?int $perPage;
    /**
     * @var int|null
     */
    #[MapFrom('current_page')]
    #[MapTo('current_page')]
    public ?int $currentPage;
    /**
     * @var int|null
     */
    #[MapFrom('total_items')]
    #[MapTo('total_items')]
    public ?int $total;
    /**
     * @var int|null
     */
    #[MapFrom('total_pages')]
    #[MapTo('total_pages')]
    public ?int $totalPages;

    /**
     * @return string|null
     */
    public function getFirst(): ?string
    {
        return $this->first;
    }

    /**
     * @param  string|null  $first
     * @return PaginationDTO
     */
    public function setFirst(?string $first): self
    {
        $this->first = $first;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLast(): ?string
    {
        return $this->last;
    }

    /**
     * @param  string|null  $last
     * @return PaginationDTO
     */
    public function setLast(?string $last): self
    {
        $this->last = $last;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrev(): ?string
    {
        return $this->prev;
    }

    /**
     * @param  string|null  $prev
     * @return PaginationDTO
     */
    public function setPrev(?string $prev): self
    {
        $this->prev = $prev;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param  string|null  $next
     * @return PaginationDTO
     */
    public function setNext(?string $next): self
    {
        $this->next = $next;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param  int|null  $total
     * @return PaginationDTO
     */
    public function setTotal(?int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param  int|null  $perPage
     * @return PaginationDTO
     */
    public function setPerPage(?int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    /**
     * @param  int|null  $currentPage
     * @return PaginationDTO
     */
    public function setCurrentPage(?int $currentPage): self
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    /**
     * @param  int|null  $totalPages
     * @return PaginationDTO
     */
    public function setTotalPages(?int $totalPages): self
    {
        $this->totalPages = $totalPages;
        return $this;
    }
}
