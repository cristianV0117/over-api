<?php

declare(strict_types=1);

namespace Src\Application\User\Domain\ValueObjects;

use Src\Application\User\Domain\Exceptions\UserImportFailedException;
use Src\Shared\Domain\Helpers\HttpCodesHelper;
use Src\Shared\Domain\ValueObjects\CriteriaValueObject;

final class UserStoreImportCriteria extends CriteriaValueObject
{
    use HttpCodesHelper;

    private const COLUMNS = [
        "user_name",
        "first_name",
        "second_name",
        "first_last_name",
        "second_last_name",
        "email",
        "cellphone",
        "password",
        "state_id"
    ];

    private const DATA_REQUIRED = [
        "user_name",
        "first_name",
        "first_last_name",
        "email",
        "cellphone",
        "password",
        "state_id"
    ];

    private const DATA_TYPE = [
        'string',
        'string',
        'string',
        'string',
        'string',
        'string',
        'integer',
        'string',
        'integer'
    ];

    private const PASSWORD = 'password';

    /**
     * @var array
     */
    private array $columns;

    /**
     * @var array
     */
    private array $rows;

    /**
     * @param mixed $value
     * @throws UserImportFailedException
     */
    public function __construct(private readonly mixed $value)
    {
        $this->isEmptyFile();

        $this->propertyAssignment();

        $this->serializeNullData();

        $this->columnsValidator();

        $this->rowsValidator();

        parent::__construct($this->value);
    }

    /**
     * @return array
     */
    public function handler(): array
    {
        return $this->rows;
    }

    /**
     * @throws UserImportFailedException
     */
    private function columnsValidator(): void
    {
        $this->cleanColumnsFromSpaces();
        $this->isColumnsCorrect();
        $this->isColumnsRightPosition();
        $this->rowsAssigmentColumns();
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function rowsValidator(): void
    {
        $this->isRowsRequired();
        $this->isRowsType();
        $this->modifyPassword();
        $this->assigmentDates();
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function isEmptyFile(): void
    {
        if (count($this->value[0]) <= 1) {
            throw new UserImportFailedException("No puedes importar archivos vacios", $this->badRequest());
        }
    }

    /**
     * @return void
     */
    private function propertyAssignment(): void
    {
        $import = $this->value;
        $this->columns = $import[0];
        unset($import[0]);
        $this->rows = $import;
    }

    /**
     * @return void
     */
    private function serializeNullData(): void
    {
        $this->columns = array_filter($this->columns, fn($value) => !is_null($value) && $value != " ");

        $this->rows = array_map(function ($array) {
            return array_filter($array, function ($value, $key) {
                if ($key > 8) {
                    return !is_null($value) && $value != " ";
                } else {
                    return true;
                }
            }, ARRAY_FILTER_USE_BOTH);
        }, $this->rows);

        $this->rows = array_filter($this->rows, function (array $subArray) {
            return !self::subArrayAllNulls($subArray);
        });
    }

    /**
     * @return void
     */
    private function cleanColumnsFromSpaces(): void
    {
        $this->columns = array_map(function ($value) {
            return trim($value);
        }, $this->columns);
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function isColumnsCorrect(): void
    {
        $message = '';
        $validation = array_diff(self::COLUMNS, $this->columns);
        if (!empty($validation)) {
            $response = array_map(function ($value) use ($message) {
                $message .= $value . '|';
                return $message;
            }, $validation);
            $response = substr(implode(array_unique($response)), 0, -1);
            throw new UserImportFailedException(
                sprintf('Existen errores de sintaxis en las siguientes columnas: %s', $response),
                $this->badRequest()
            );
        }
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function isColumnsRightPosition(): void
    {
        if (self::COLUMNS !== $this->columns) {
            throw new UserImportFailedException(
                sprintf(
                    'Verifica que el orden de las columnas esten correctas al siguiente orden: %s',
                    json_encode(
                        self::COLUMNS
                    )
                ),
                $this->badRequest()
            );
        }
    }

    /**
     * @return void
     */
    private function rowsAssigmentColumns(): void
    {
        $this->rows = array_map(function ($array) {
            return array_combine($this->columns, $array);
        }, $this->rows);
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function isRowsRequired(): void
    {
        $message = null;
        $response = array_map(function ($array, $arrayKey) use ($message) {
            $implode = array_map(function ($value, $key) use ($message, $arrayKey) {
                if (in_array($key, self::DATA_REQUIRED)) {
                    if (is_null($value)) {
                        $message .= sprintf(
                            "El valor de %s del registro %s es requerido%s",
                            $key,
                            $arrayKey,
                            '|'
                        );
                        return $message;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }, $array, array_keys($array));
            return implode($implode);
        }, $this->rows, array_keys($this->rows));

        if (!empty(implode($response))) {
            throw new UserImportFailedException(
                implode($response),
                $this->badRequest()
            );
        }
    }

    /**
     * @return void
     * @throws UserImportFailedException
     */
    private function isRowsType(): void
    {
        $message = "Existe un error con los tipos de datos de: ";

        $getType = array_map(function ($array) {
            return array_map(function ($value) {
                return gettype($value);
            }, $array);
        }, $this->rows);

        $response = array_map(function ($getTypeValues, $getTypeKeys) use ($message) {
            return implode(array_map(function ($dataType, $value, $key) use ($message, $getTypeKeys) {
                if ($dataType !== $value) {
                    $message .= sprintf(
                        "%s en el registro %s |",
                        $key,
                        $getTypeKeys
                    );
                    return $message;
                } else {
                    return null;
                }
            }, self::DATA_TYPE, $getTypeValues, array_keys($getTypeValues)));
        }, $getType, array_keys($getType));

        if (!empty(implode($response))) {
            throw new UserImportFailedException(
                implode($response),
                $this->badRequest()
            );
        }
    }

    /**
     * @return void
     */
    private function modifyPassword(): void
    {
        $this->rows = array_map(function ($array) {
            return array_map(function ($value, $key) {
                if (self::PASSWORD === $key) {
                    return password_hash($value, PASSWORD_DEFAULT);
                }

                return $value;
            }, $array, array_keys($array));
        }, $this->rows);
        $this->rowsAssigmentColumns();
    }

    /**
     * @return void
     */
    private function assigmentDates(): void
    {
        $this->rows = array_map(function ($array) {
            $array['created_at'] = now();
            $array['updated_at'] = now();
            return $array;
        }, $this->rows);
    }

    /**
     * @param $subArray
     * @return bool
     */
    private static function subArrayAllNulls($subArray): bool
    {
        return array_reduce($subArray, function ($allNulls, $value) {
            return $allNulls && is_null($value) || $value === " ";
        }, true);
    }
}
