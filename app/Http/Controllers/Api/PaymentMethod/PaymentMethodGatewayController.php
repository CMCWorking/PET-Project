<?php

namespace App\Http\Controllers\Api\PaymentMethod;

use JulioMotol\Lapiv\GatewayController;

class PaymentMethodGatewayController extends GatewayController
{
    protected array $apiControllers = [
        PaymentMethodV1Controller::class,
    ];
}
