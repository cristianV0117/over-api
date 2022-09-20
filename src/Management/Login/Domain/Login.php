<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotRoleException;
use Src\Shared\Domain\Domain;

final class Login extends Domain
{
    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = "natural";

    /**
     * @param mixed $entity
     */
    public function __construct(private mixed $entity)
    {
        parent::__construct($entity);
    }

    /**
     * @return array
     */
    public function handler(): array
    {
        return [
            "id" => $this->entity["id"],
            "user_name" => $this->entity["user_name"],
            "email" => $this->entity["email"],
            "roles" => (!empty($this->entity["roles"])) ? [
                        "id" => $this->entity["roles"][0]["id"],
                        "name" => $this->entity["roles"][0]["name"]
                    ] : [
                        "id" => self::ID_ROLE_DEFAULT,
                        "name" => self::NAME_ROLE_DEFAULT
                    ]
        ];
    }

    /**
     * @return bool
     * @throws NotRoleException
     */
    public function isUserCheckRole(): bool
    {
        if ("*" === $this->entity["typeRole"]) {
            return true;
        }

        if ($this->entity["user"]->roles->name !== $this->entity["typeRole"]) {
            throw new NotRoleException("your role does not have permissions", 400);
        }

        return true;
    }
}
