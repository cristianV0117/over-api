<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Application\User\Application\Get\UserCriteriaUseCase;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Criteria\HandlerCriteria;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Output\OutputFactory;

final class UserCriteriaController extends CustomController
{
    use HttpCodesHelper;

    /**
     * @param UserCriteriaUseCase $useCase
     * @param OutputFactory $outputFactory
     */
    public function __construct(
        private readonly UserCriteriaUseCase $useCase,
        private readonly OutputFactory $outputFactory
    )
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        return $this->outputFactory->outPut(
            status: $this->ok(),
            error: false,
            response: $this->useCase->__invoke(
                (new HandlerCriteria($request->toArray()))->criteria()
            )->entity()
        );
    }
}
