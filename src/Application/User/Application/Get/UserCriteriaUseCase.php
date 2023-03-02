<?php

declare(strict_types=1);

namespace Src\Application\User\Application\Get;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Domain\ValueObjects\UserCriteria;

final class UserCriteriaUseCase
{
    /**
     * @param UserRepositoryContract $repository
     */
    public function __construct(private readonly UserRepositoryContract $repository)
    {
    }

    /**
     * @param array $criteria
     * @return User
     */
    public function __invoke(mixed $criteria): User
    {
        return $this->repository->match(new UserCriteria($criteria));
    }
}
