<?php

namespace App\Services\Market\Impls;

use App\DTO\Base\BaseListDTO;
use App\DTO\Market\MarketDTO;
use App\Exceptions\Base\BaseException;
use App\Exceptions\GeneralException;
use App\Models\Market;
use App\Repositories\Market\Interfaces\IMarketRepository;
use App\Services\Market\Interfaces\IMarketService;
use App\Transformers\Base\BaseTransformer;
use App\Transformers\MarketTransformer;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class MarketService implements IMarketService
{
    /**
     * @param IMarketRepository $marketRepository
     */
    public function __construct(
        private readonly IMarketRepository $marketRepository,
    )
    {
        //
    }

    /**
     * @return BaseListDTO
     * @throws UnknownProperties
     */
    public function getAllWithPagination(): BaseListDTO
    {
        $markets = $this->marketRepository->paginate();
        return BaseTransformer::toBaseListDTO(lengthAwarePaginator: $markets, caster: MarketDTO::class);
    }

    /**
     * @param MarketDTO $marketDTO
     * @return MarketDTO
     * @throws UnknownProperties
     */
    public function store(MarketDTO $marketDTO): MarketDTO
    {
        $market = MarketTransformer::toMarketEntity($marketDTO);
        $market = $this->marketRepository->create($market);
        return new MarketDTO($market->toArray());
    }

    /**
     * @param int $id
     * @return MarketDTO
     * @throws GeneralException
     * @throws UnknownProperties
     */
    public function getById(int $id): MarketDTO
    {
        $market = $this->marketRepository->findById(id: $id);
        if (!$market instanceof Market) {
            throw new GeneralException(exceptionErrorCode: BaseException::NOT_FOUND_ERROR);
        }

        return new MarketDTO($market->toArray());
    }

    /**
     * @param MarketDTO $marketDTO
     * @param int $id
     * @return MarketDTO
     * @throws GeneralException
     * @throws UnknownProperties
     */
    public function updateById(MarketDTO $marketDTO, int $id): MarketDTO
    {
        $market = $this->marketRepository->findById(id: $id);
        if (!$market instanceof Market) {
            throw new GeneralException(exceptionErrorCode: BaseException::NOT_FOUND_ERROR);
        }

        $market = MarketTransformer::toMarketEntity($marketDTO, $market);
        $market = $this->marketRepository->update($market);
        return new MarketDTO($market->toArray());
    }

    /**
     * @param int $id
     * @return void
     * @throws GeneralException
     */
    public function deleteById(int $id): void
    {
        $tradeCommission = $this->marketRepository->findById(id: $id,);
        if (!$tradeCommission instanceof Market) {
            throw new GeneralException(exceptionErrorCode: BaseException::NOT_FOUND_ERROR);
        }
        $this->marketRepository->delete($tradeCommission);
    }
}
