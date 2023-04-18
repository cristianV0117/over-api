<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\ValueObjects;

use Src\Application\User\Domain\Exceptions\UserImportFailedException;
use Src\Shared\Domain\Helpers\EnvHelper;
use Src\Shared\Domain\Helpers\HttpCodesHelper;
use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

class UserImportCriteria extends CriteriaValueObject
{
    use HttpCodesHelper, EnvHelper;

    private const FILE_TYPE = 'xlsx';

    private const FILE_NAME = 'users_import';

    /**
     * @param mixed $value
     * @throws UserImportFailedException
     */
    public function __construct(private readonly mixed $value)
    {
        $this->isFileType($this->value);
        $this->isNameFile($this->value);
        parent::__construct($this->value);
    }

    /**
     * @return string
     */
    public function storageFile(): string
    {
        return $this->storage();
    }

    /**
     * @return mixed
     */
    public function fileName(): string
    {
        return pathinfo($this->value->getClientOriginalName(), PATHINFO_FILENAME);
    }

    /**
     * @param mixed $file
     * @return void
     * @throws UserImportFailedException
     */
    private function isFileType(mixed $file): void
    {
        if (self::FILE_TYPE !== $file->getClientOriginalExtension()) {
            throw new UserImportFailedException("El archivo no tiene la extensión correcta", $this->badRequest());
        }
    }

    /**
     * @param mixed $file
     * @return void
     * @throws UserImportFailedException
     */
    private function isNameFile(mixed $file): void
    {
        if (self::FILE_NAME !== pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) {
            throw new UserImportFailedException("El archivo no tiene el nombre correcto", $this->badRequest());
        }
    }
}
