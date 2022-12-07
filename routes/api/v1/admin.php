<?php

use App\Http\Controllers\API\V1\Admin\MarketController;
use Illuminate\Support\Facades\Route;

Route::group([], static function ($router) {
    $router->resource('/markets', MarketController::class)->except(['update']);
    $router->post('/markets/{market}', [MarketController::class, 'update']);
});
