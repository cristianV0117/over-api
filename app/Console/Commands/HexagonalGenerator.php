<?php

namespace App\Console\Commands;

use App\Exceptions\HexagonalException;

final class HexagonalGenerator extends HexagonalCustomGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hexagonal:generator {boundedContext}{entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create hexagonal architecture template';

    private const DOMAIN_ELEMENTS = [
        'Contracts',
        'Exceptions',
        'ValueObjects'
    ];

    private const INFRASTRUCTURE_ELEMENTS = [
        'Controllers',
        'Repositories',
        'Request',
        'Routes',
        'Services'
    ];

    private const APPLICATION_ELEMENTS = [
        'Get',
        'Store',
        'Update',
        'Destroy'
    ];

    /**
     * @return void
     * @throws HexagonalException
     */
    public function handle(): void
    {
        $this->isFilesExist();
        $this->generateEntityFolder();
        $this->generateHexagonalArchitecture();
        $this->generateHexagonalArchitectureElements(
            self::DOMAIN,
            self::DOMAIN_ELEMENTS
        );
        $this->generateHexagonalArchitectureElements(
            self::INFRASTRUCTURE,
            self::INFRASTRUCTURE_ELEMENTS
        );
        $this->generateHexagonalArchitectureElements(
            self::APPLICATION,
            self::APPLICATION_ELEMENTS
        );
    }

    /**
     * @return void
     * @throws HexagonalException
     */
    private function generateEntityFolder(): void
    {
        $entity = $this->filesystem->makeDirectory($this->entityPath(), 0777, true, true);

        if (!$entity) {
            throw new HexagonalException("an error has occurred with " . $entity);
        }

        $this->info("Entity created");
    }

    /**
     * @return void
     * @throws HexagonalException
     */
    private function generateHexagonalArchitecture(): void
    {
        foreach (self::HEXAGONAL_ELEMENTS as $value) {
            $status = $this->filesystem->makeDirectory($this->entityPath() . '/' . $value, 0777, true, true);
            if (!$status) {
                throw new HexagonalException("an error has occurred with " . $value);
            }
        }
        $this->info("Hexagonal folders created");
    }

    /**
     * @param string|null $folder
     * @param array $elements
     * @return void
     * @throws HexagonalException
     */
    private function generateHexagonalArchitectureElements(
        ?string $folder,
        array $elements
    ): void
    {
        foreach ($elements as $value) {
            $status = $this->filesystem->makeDirectory($this->entityPath() . '/' . $folder . '/' . $value, 0777, true, true);
            if (!$status) {
                throw new HexagonalException("an error has occurred with " . $value);
            }
        }
        $this->info("Hexagonal elements created");
    }

    /**
     * @return void
     * @throws HexagonalException
     */
    protected function isFilesExist(): void
    {
        if (!file_exists($this->rootPath())) {
            throw new HexagonalException("you must create the src folder ", 500);
        }

        if (file_exists($this->entityPath())) {
            throw new HexagonalException("The entity " . $this->entity() . " already exist");
        }
    }
}
