<?php

declare(strict_types=1);

namespace Src\Application\Home\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Router;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HateoasHelper;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

final class HomeController extends CustomController
{
    use HateoasHelper, HttpCodesHelper;

    /**
     * @param Router $router
     * @return JsonResponse
     */
    public function __invoke(Router $router): JsonResponse
    {
        return $this->defaultJsonResponse(
            $this->ok(),
            false,
            [
                "over" => "OVER API",
                "home" => "Bienvenido",
                "version" => env("APP_SPECIFIC_VERSION"),
                "hateoas" => $this->hateoas($router->getRoutes())
            ]
        );
    }
}
