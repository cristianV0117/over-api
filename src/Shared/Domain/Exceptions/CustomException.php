<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Exceptions;

class CustomException extends \Exception
{
    /**
     * @return array
     */
    public function toException(): array
    {
        $classTemporally = new \ReflectionClass(get_class($this));
        $class = explode('\\', $classTemporally->getName());
        return [
            'status' => $this->getCode(),
            'error' => true,
            'class' => end($class),
            'message' => $this->getMessage()
        ];
    }
}
