<?php

declare(strict_types=1);

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Management\Login\Domain\Exceptions\NotRoleException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helpers\HttpCodesHelper;

final class Login extends Domain
{
    use HttpCodesHelper;

    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = "natural";
    private const USER_OR_PASSWORD_INCORRECT = 'USER_OR_PASSWORD_INCORRECT';

    /**
     * @return array
     */
    public function handler(): array
    {
        return [
            "id" => $this->entity()["id"],
            "user_name" => $this->entity()["user_name"],
            "email" => $this->entity()["email"],
            "roles" => [
                "id" => $this->entity()["roles"][0]["id"] ?? self::ID_ROLE_DEFAULT,
                "name" => $this->entity()["roles"][0]["name"] ?? self::NAME_ROLE_DEFAULT
            ]
        ];
    }

    /**
     * @return bool
     * @throws NotRoleException
     */
    public function isUserCheckRole(): bool
    {
        if ("*" === $this->entity()["typeRole"]) {
            return true;
        }

        if ($this->entity()["user"]->roles->name !== $this->entity()["typeRole"]) {
            throw new NotRoleException("your role does not have permissions", 400);
        }

        return true;
    }

    /**
     * @param string|null $exception
     * @return void
     * @throws NotLoginException
     */
    protected function isException(?string $exception): void
    {
        if (!is_null($exception)) {
            match ($exception) {
                self::USER_OR_PASSWORD_INCORRECT => throw new NotLoginException("email, user name or password incorrect", $this->unauthorized())
            };
        }
    }
}
