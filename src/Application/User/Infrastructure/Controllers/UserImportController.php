<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\Application\User\Application\Import\UserImportUseCase;
use Src\Application\User\Application\Store\UserStoreImportUseCase;
use Src\Application\User\Domain\Exceptions\UserImportFailedException;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;

class UserImportController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(
        private readonly UserImportUseCase $userImportUseCase,
        private readonly UserStoreImportUseCase $userStoreImportUseCase
    )
    {
    }

    /**
     * @param Request $request
     * @return void
     * @throws UserImportFailedException
     */
    public function __invoke(Request $request)
    {
        if (!$request->file()) {
            throw new UserImportFailedException("Debes importar el archivo", $this->badRequest());
        }

        $import = $this->userStoreImportUseCase->__invoke(
            $this->userImportUseCase->__invoke($request->file()["import"])
        );
        dd($import);
    }
}
