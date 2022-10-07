<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

abstract class HexagonalCustomGenerator extends Command
{
    protected const HEXAGONAL_ELEMENTS = [
        'Domain',
        'Application',
        'Infrastructure'
    ];

    protected const DOMAIN = 'Domain';

    protected const APPLICATION = 'Application';

    protected const INFRASTRUCTURE = 'Infrastructure';

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(
        protected Filesystem $filesystem
    )
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    protected function boundedContext(): string
    {
        return ucfirst($this->argument('boundedContext'));
    }

    /**
     * @return string
     */
    protected function entity(): string
    {
        return ucfirst($this->argument('entity'));
    }

    /**
     * @return string
     */
    protected function entityPath(): string
    {
        return $this->rootPath() . "/" . $this->boundedContext() . "/" . $this->entity();
    }

    /**
     * @return string
     */
    protected function rootPath(): string
    {
        return __DIR__.'/../../../src';
    }

    /**
     * @param string $stub
     * @param array $stubDependencies
     * @return array|false|string|string[]
     */
    protected function getStubContents(string $stub, array $stubDependencies): array|bool|string
    {
        $contents = file_get_contents($stub);

        foreach ($stubDependencies as $search => $replace) {
            $contents = str_replace('{'.$search.'}', $replace, $contents);
        }

        return $contents;
    }

    /**
     * @return void
     */
    abstract protected function isFilesExist(): void;
}
