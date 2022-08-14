<?php

declare(strict_types=1);

namespace Src\Shared\Infrastructure\Helper;

use Illuminate\Support\Collection;

trait HateoasHelper
{
    /**
     * @param object $router
     * @return array
     */
    public function hateoas(object $router): array
    {
        return $this->serializeRoutes($this->collectRoutes($router));
    }

    /**
     * @param object $router
     * @return Collection
     */
    private function collectRoutes(object $router): Collection
    {
        return collect($router->getRoutes())->map(function ($route) {
            if ("GET" === $route->methods()[0]) {
                return [
                    "routes" => env("DOMAIN_ROUTE") . "/" . $route->uri(),
                    "uri" => $route->uri()
                ];
            }
        });
    }

    /**
     * @param $routes
     * @return array
     */
    private function serializeRoutes($routes): array
    {
        foreach ($routes as $key => $value) {
            if (!is_null($value)) {
                $search = strpos($value["routes"], "_");
                if (
                    is_numeric($search) ||
                    in_array($value["uri"], $this->routesExcept(), true)
                ) {
                    unset($routes[$key]);
                }
            }
        }
        $response = array_filter($routes->toArray(), static function ($value) {
            return $value !== null;
        });
        return array_values($response);
    }

    /**
     * @return string[]
     */
    private function routesExcept(): array
    {
        return [
            "sanctum/csrf-cookie",
            "_ignition/health-check",
            "api",
            "/"
        ];
    }
}
