<?php

namespace Src\Application\Role\Infrastructure\Services;

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
            'api/' . $appVersion . '/roles',
            'Src\Application\Role\Infrastructure\Controllers',
            'src/Application/Role/Infrastructure/Routes/Api.php',
            false
        );
        parent::__construct($app);
    }
}
