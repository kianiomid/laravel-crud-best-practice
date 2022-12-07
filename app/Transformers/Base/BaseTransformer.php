<?php

namespace App\Transformers\Base;

use App\DTO\Base\BaseListDTO;
use App\DTO\Base\PaginationDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class BaseTransformer
{
    /**
     * @param LengthAwarePaginator $lengthAwarePaginator
     * @return PaginationDTO
     */
    protected static function toPaginatedDTO(LengthAwarePaginator $lengthAwarePaginator): PaginationDTO
    {
        $pagination = $lengthAwarePaginator->toArray();
        return (new PaginationDTO())->setFirst($pagination['first_page_url'] ?? null)
            ->setLast($pagination['last_page_url'] ?? null)
            ->setPrev($pagination['prev_page_url'] ?? null)
            ->setNext($pagination['next_page_url'] ?? null)
            ->setTotal($lengthAwarePaginator->total())
            ->setPerPage($lengthAwarePaginator->perPage())
            ->setCurrentPage($lengthAwarePaginator->currentPage())
            ->setTotalPages($lengthAwarePaginator->lastPage());
    }

    /**
     * @param LengthAwarePaginator|null $lengthAwarePaginator
     * @param Collection|null $collection
     * @param string|null $caster
     * @param array|null $except
     * @param array|null $only
     * @return BaseListDTO
     * @throws UnknownProperties
     */
    final public static function toBaseListDTO(
        ?LengthAwarePaginator $lengthAwarePaginator = null,
        ?Collection           $collection = null,
        ?string               $caster = null,
        ?array                $except = [],
        ?array                $only = [],
    ): BaseListDTO
    {
        if ($lengthAwarePaginator) {
            $paginationDTO = self::toPaginatedDTO($lengthAwarePaginator);
            $data = $lengthAwarePaginator->toArray()['data'];
            $baseListDTO = new BaseListDTO(
                data: $data,
                pagination: $paginationDTO,
                caster: $caster,
                except: $except,
                only: $only
            );
        } else {
            $data = $collection ? $collection->toArray() : [];
            $baseListDTO = new BaseListDTO(data: $data, caster: $caster, except: $except, only: $only);
        }
        return $baseListDTO;
    }
}
