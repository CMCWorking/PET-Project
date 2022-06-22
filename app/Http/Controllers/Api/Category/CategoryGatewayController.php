<?php

namespace App\Http\Controllers\Api\Category;

use JulioMotol\Lapiv\GatewayController;

class CategoryGatewayController extends GatewayController
{
    protected array $apiControllers = [
        CategoryV1Controller::class,
    ];
}
