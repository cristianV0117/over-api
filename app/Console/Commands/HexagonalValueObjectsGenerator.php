<?php

namespace App\Console\Commands;

use App\Exceptions\HexagonalException;

class HexagonalValueObjectsGenerator extends HexagonalCustomGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hexagonal:value-object {boundedContext}{entity}{value-objects*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private const FOLDER = 'ValueObjects';

    private const INTEGER = 'integer';

    private const STRING = 'string';

    private const CRITERIA = 'criteria';

    /**
     * @return void
     * @throws HexagonalException
     */
    public function handle(): void
    {
        $this->isFilesExist();
        $this->generateValueObjectFromStub(
            "Src\\{$this->boundedContext()}\\{$this->entity()}\\". self::DOMAIN ."\\". self::FOLDER
        );
    }

    /**
     * @return array
     */
    private function valueObjects(): array
    {
        return $this->argument('value-objects');
    }

    /**
     * @param string $namespaceForEntity
     * @return void
     */
    private function generateValueObjectFromStub(
        string $namespaceForEntity
    ): void
    {
        array_map(function ($value) use ($namespaceForEntity) {
            $stub = '';
            $elements = explode(':', $value);
            if (self::INTEGER === $elements[1]) {
                $stub = __DIR__ . '/../Stubs/IntegerValueObject.stub';
            }
            if (self::STRING === $elements[1]) {
                $stub = __DIR__ . '/../Stubs/StringValueObject.stub';
            }
            if (self::CRITERIA === $elements[1]) {
                $stub = __DIR__ . '/../Stubs/CriteriaValueObject.stub';
            }
            $this->generateEntityFromStub(
                $stub,
                $namespaceForEntity,
                $elements[0]
            );
        }, $this->valueObjects());
    }

    /**
     * @param string $entityStubPath
     * @param string $namespaceForEntity
     * @param string $valueObject
     * @return void
     */
    private function generateEntityFromStub(
        string $entityStubPath,
        string $namespaceForEntity,
        string $valueObject
    ): void
    {
        $entityStubContents = $this->getStubContents(
            $entityStubPath,
            [
                'namespace' => $namespaceForEntity,
                'class' => $valueObject
            ]
        );
        $this->filesystem->put("{$this->entityPath()}/" . self::DOMAIN . "/" . self::FOLDER . "/$valueObject.php", $entityStubContents);
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

        if (!file_exists($this->entityPath() . '/'. self::DOMAIN . '/'. self::FOLDER)) {
            throw new HexagonalException(self::FOLDER . " not exist", 500);
        }
    }
}
