<?php

declare(strict_types=1);

namespace Src\Management\Logger\Domain\ValueObjects;

use Src\Shared\Domain\Helpers\ClientHelper;
use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class LoggerLogin extends CriteriaValueObject
{
    use ClientHelper;

    /**
     * @var object|array
     */
    private object|array $handler;

    /**
     * @param object|array $value
     */
    public function __construct(object|array $value)
    {
        parent::__construct($value);
        $this->handler = $value;
        $this->attachClientDependencies();
    }

    /**
     * @return object|array
     */
    public function handler(): object|array
    {
        return $this->handler;
    }

    /**
     * @return void
     */
    public function attachClientDependencies(): void
    {
        $this->handler = array_merge($this->handler, [
            'ip' => $this->ip(),
            'browser' => $this->browser(),
            'os' => $this->os()
        ]);
    }
}
