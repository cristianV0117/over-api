<?php

declare(strict_types=1);

namespace Src\Application\Task\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class TaskCriteria extends CriteriaValueObject
{
    /**
     * @return array
     */
    public function handler(): array
    {
        $newValue = $this->value();
        unset($newValue["category_task"]);
        return $newValue;
    }
}
