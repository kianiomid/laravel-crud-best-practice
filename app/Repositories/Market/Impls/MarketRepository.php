<?php

namespace App\Repositories\Market\Impls;

use App\Models\Market;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Market\Interfaces\IMarketRepository;

class MarketRepository extends BaseRepository implements IMarketRepository
{
    /**
     * @param Market $model
     */
    public function __construct(Market $model)
    {
        parent::__construct($model);
    }
}
