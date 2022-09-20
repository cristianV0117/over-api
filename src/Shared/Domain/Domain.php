<?php

declare(strict_types=1);

namespace Src\Shared\Domain;

abstract class Domain
{
    /**
     * @var array|bool|null
     */
    private array|null|bool $exception;

    /**
     * @param mixed $entity
     */
    public function __construct(private mixed $entity)
    {
    }

    /**
     * @return mixed
     */
    public function entity(): mixed
    {
        return $this->entity;
    }

    /**
     * @param array|bool|null $exception
     * @return void
     */
    public function setException(array|null|bool $exception): void
    {
        $this->exception = $exception;
    }

    /**
     * @return bool|array|null
     */
    public function exception(): bool|array|null
    {
        return $this->exception;
    }

    /**
     * @return int
     */
    public function exceptionCode(): int
    {
        return $this->exception["code"];
    }

    /**
     * @return string
     */
    public function exceptionMessage(): string
    {
        return $this->exception["message"];
    }
}
