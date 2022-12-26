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

    /**
     * @param array $rolesAllowed
     * @return array
     */
    public function rolesAllowed(array $rolesAllowed): array
    {
        return $rolesAllowed;
    }
}
