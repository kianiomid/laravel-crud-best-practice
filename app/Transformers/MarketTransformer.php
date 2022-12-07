<?php

namespace App\Transformers;

use App\DTO\Market\MarketDTO;
use App\Models\Market;
use App\Transformers\Base\BaseTransformer;

class MarketTransformer extends BaseTransformer
{
    /**
     * @param  MarketDTO  $marketDTO
     * @param  Market|null  $market
     * @return Market
     */
    final public static function toMarketEntity(MarketDTO $marketDTO, ?Market $market = null): Market
    {
        $market = $market ?? new Market();
        $market->setAttribute('title', $marketDTO->getTitle());
        $market->setAttribute('name', $marketDTO->getName());
        $market->setAttribute('description', $marketDTO->getDescription());
        $market->setAttribute('enabled', $marketDTO->isEnabled());
        return $market;
    }
}
