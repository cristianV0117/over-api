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

    private const ALL_ROLES_ALLOWED = "*";
    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = "natural";
    private const USER_OR_PASSWORD_INCORRECT = "USER_OR_PASSWORD_INCORRECT";
    private const ROLE_NOT_HAVE_PERMISSIONS = "ROLE_NOT_HAVE_PERMISSIONS";

    /**
     * @throws NotRoleException
     * @throws NotLoginException
     */
    public function __construct(private mixed $entity = null, private ?string $exception = null)
    {
        parent::__construct($this->entity, $this->exception);
        $this->isUserCheckRole();
    }

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
     * @throws NotRoleException|NotLoginException
     */
    public function isUserCheckRole(): bool
    {
        if (
            !array_key_exists("user", $this->entity()) &&
            !array_key_exists("typeRoles", $this->entity())
        ) {
            return true;
        }

        if (is_array($this->entity()["typeRoles"])) {
            if (!in_array($this->entity()["user"]->roles->name, $this->entity()["typeRoles"])) {
                $this->isException('ROLE_NOT_HAVE_PERMISSIONS');
            }

            return true;
        }

        if (self::ALL_ROLES_ALLOWED === $this->entity()["typeRoles"]) {
            return true;
        }

        if ($this->entity()["user"]->roles->name !== $this->entity()["typeRoles"]) {
            $this->isException('ROLE_NOT_HAVE_PERMISSIONS');
        }

        return true;
    }

    /**
     * @param string|null $exception
     * @return void
     * @throws NotLoginException
     * @throws NotRoleException
     */
    protected function isException(?string $exception): void
    {
        if (!is_null($exception)) {
            match ($exception) {
                self::USER_OR_PASSWORD_INCORRECT => throw new NotLoginException("email, user name or password incorrect", $this->unauthorized()),
                self::ROLE_NOT_HAVE_PERMISSIONS => throw new NotRoleException("your role does not have permissions", $this->unauthorized())
            };
        }
    }
}
