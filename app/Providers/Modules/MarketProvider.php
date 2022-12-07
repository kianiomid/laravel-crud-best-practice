<?php

namespace App\Providers\Modules;

use App\Repositories\Market\Impls\MarketCacheRepository;
use App\Repositories\Market\Impls\MarketRepository;
use App\Repositories\Market\Interfaces\IMarketCacheRepository;
use App\Repositories\Market\Interfaces\IMarketRepository;
use App\Services\Market\Impls\MarketService;
use App\Services\Market\Interfaces\IMarketService;
use Illuminate\Support\ServiceProvider;

class MarketProvider extends ServiceProvider
{
    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        IMarketService::class => MarketService::class,
        IMarketCacheRepository::class => MarketCacheRepository::class,
        IMarketRepository::class => MarketRepository::class,
    ];
}
