<?php

namespace App\Services\Market\Interfaces;

use App\DTO\Base\BaseListDTO;
use App\DTO\Market\MarketDTO;
use App\Exceptions\Base\BaseException;
use App\Exceptions\GeneralException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Throwable;

interface IMarketService
{
    /**
     * @return BaseListDTO
     * @throws UnknownProperties
     */
    public function getAllWithPagination(): BaseListDTO;

    /**
     * @param MarketDTO $marketDTO
     * @return MarketDTO
     * @throws UnknownProperties
     */
    public function store(MarketDTO $marketDTO): MarketDTO;

    /**
     * @param int $id
     * @return MarketDTO
     * @throws UnknownProperties
     * @throws BaseException
     */
    public function getById(int $id): MarketDTO;

    /**
     * @param MarketDTO $marketDTO
     * @param int $id
     * @return MarketDTO
     * @throws UnknownProperties
     * @throws BaseException
     */
    public function updateById(MarketDTO $marketDTO, int $id): MarketDTO;

    /**
     * @param int $id
     * @return void
     * @throws GeneralException
     * @throws UnknownProperties
     * @throws Throwable
     */
    public function deleteById(int $id): void;
}
