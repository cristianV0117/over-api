<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Repositories\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
final class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private readonly int $id;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $task;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $description;

    /**
     * @ORM\Column(type="integer")
     */
    private readonly int $status;

    /**
     * @ORM\Column(type="integer")
     */
    private readonly int $priority;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $dead_line;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $closing_date;

    /**
     * @ORM\Column(type="integer")
     */
    private readonly int $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    private readonly int $categorie_task_id;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $updated_at;

    /**
     * @ORM\Column(type="string")
     */
    private readonly string $created_at;
}
