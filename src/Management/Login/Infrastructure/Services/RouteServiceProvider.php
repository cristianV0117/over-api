<?php

declare(strict_types=1);

namespace Src\Management\Login\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $appVersion = env("APP_VERSION");
        $this->setDependency(
            'api/' . $appVersion . '/login',
            'Src\Management\Login\Infrastructure\Controllers',
            'src/Management/Login/Infrastructure/Routes/Api.php',
            true
        );
        parent::__construct($app);
    }
}
