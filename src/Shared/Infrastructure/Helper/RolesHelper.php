<?php

namespace Src\Shared\Infrastructure\Helper;

trait RolesHelper
{
    /**
     * @return string
     */
    public function superAdmin(): string
    {
        return 'super_admin';
    }

    /**
     * @return string
     */
    public function allRoles(): string
    {
        return '*';
    }
}
