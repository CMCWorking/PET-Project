<?php

namespace App\Http\Controllers\Api\CustomerInformation;

use JulioMotol\Lapiv\GatewayController;
use App\Http\Controllers\Api\CustomerInformation\CustomerInformationV1Controller;

class CustomerInformationGatewayController extends GatewayController
{
    protected array $apiControllers = [
        CustomerInformationV1Controller::class,
    ];
}
