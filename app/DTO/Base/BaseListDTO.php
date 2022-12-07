<?php

namespace App\DTO\Base;

use ArrayAccess;
use LogicException;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Traversable;

class BaseListDTO extends DataTransferObject
{
    /**
     * @var array|string[]
     */
    public static array $types = ['array'];

    /**
     * @param  array  $data
     * @param  PaginationDTO|null  $pagination
     * @param  string|null  $caster
     * @param  array|null  $except
     * @param  array|null  $only
     * @throws UnknownProperties
     */
    public function __construct(
        array $data,
        ?PaginationDTO $pagination = null,
        private readonly ?string $caster = null,
        private readonly ?array $except = [],
        private readonly ?array $only = [],
    ) {
        if ($caster) {
            $data = $this->cast($data);
        }
        parent::__construct(data: $data, pagination: $pagination);
    }

    /**
     * @var array
     */
    #[MapFrom('data')]
    #[MapTo('data')]
    public array $data;

    /**
     * @var PaginationDTO|null
     */
    #[MapFrom('pagination')]
    #[MapTo('pagination')]
    public ?PaginationDTO $pagination;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param  array  $data
     * @return BaseListDTO
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return PaginationDTO|null
     */
    public function getPagination(): ?PaginationDTO
    {
        return $this->pagination;
    }

    /**
     * @param  PaginationDTO|null  $pagination
     * @return BaseListDTO
     */
    public function setPagination(?PaginationDTO $pagination): self
    {
        $this->pagination = $pagination;
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Spatie ArrayCaster functions (with a little bit changes)
    |--------------------------------------------------------------------------
    */
    /**
     * @param  mixed  $value
     * @return array|ArrayAccess
     */
    private function cast(mixed $value): array|ArrayAccess
    {
        foreach (self::$types as $type) {
            if ($type === 'array') {
                return $this->mapInto(
                    destination: [],
                    items: $value
                );
            }

            if (is_subclass_of($type, ArrayAccess::class)) {
                return $this->mapInto(
                    destination: new $type(),
                    items: $value
                );
            }
        }

        throw new LogicException(
            "Caster [ArrayCaster] may only be used to cast arrays or objects that implement ArrayAccess."
        );
    }

    /**
     * @param  array|ArrayAccess  $destination
     * @param  mixed  $items
     * @return array|ArrayAccess
     */
    private function mapInto(array|ArrayAccess $destination, mixed $items): array|ArrayAccess
    {
        if ($destination instanceof ArrayAccess && !is_subclass_of($destination, Traversable::class)) {
            throw new LogicException(
                "Caster [ArrayCaster] may only be used to cast ArrayAccess objects that are traversable."
            );
        }

        foreach ($items as $key => $item) {
            $destination[$key] = $this->castItem($item);
        }

        return $destination;
    }

    /**
     * @param  mixed  $data
     * @return mixed
     */
    private function castItem(mixed $data): mixed
    {
        if ($data instanceof $this->caster) {
            return $data;
        }

        if (is_array($data)) {
            return (new $this->caster(...$data))->except(...$this->except)->only(...$this->only);
        }

        throw new LogicException(
            "Caster [ArrayCaster] each item must be an array or an instance of the specified item type [{$this->caster}]."
        );
    }
}
