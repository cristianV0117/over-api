<?php

declare(strict_types=1);

namespace Src\Management\Forgot\Infrastructure\Services;

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
            'api/' . $appVersion . '/forgot',
            'Src\Management\Forgot\Infrastructure\Controllers',
            'src/Management/Forgot/Infrastructure/Routes/Api.php',
            true
        );
        parent::__construct($app);
    }
}
