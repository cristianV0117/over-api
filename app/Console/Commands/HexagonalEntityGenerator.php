<?php

namespace App\Console\Commands;

use App\Exceptions\HexagonalException;

final class HexagonalEntityGenerator extends HexagonalCustomGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hexagonal:entity {boundedContext}{entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate hexagonal entity template';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws HexagonalException
     */
    public function handle(): void
    {
        $this->isFilesExist();
        $this->generateEntityFromStub(
            __DIR__ . '/../Stubs/Entity.stub',
            "Src\\{$this->boundedContext()}\\{$this->entity()}\\". self::DOMAIN
        );
    }

    private function generateEntityFromStub(
        string $entityStubPath,
        string $namespaceForEntity
    )
    {
        $entityStubContents = $this->getStubContents(
            $entityStubPath,
            [
                'namespace' => $namespaceForEntity,
                'class' => $this->entity()
            ]
        );
        $this->filesystem->put("{$this->entityPath()}/" . self::DOMAIN . "/{$this->entity()}.php", $entityStubContents);
        $this->info("File created");
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

        if (!file_exists($this->entityPath())) {
            throw new HexagonalException("Entity not exist", 500);
        }
    }
}
