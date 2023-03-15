<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Src\Application\User\Domain\Exceptions\UserRequestFailedException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class UserStoreRequest extends FormRequest
{
    use RequestHelper, HttpCodesHelper;

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|max:45',
            'first_name' => 'required|max:45',
            'second_name' => 'nullable|max:45',
            'first_last_name' => 'required|max:45',
            'second_last_name' => 'nullable|max:45',
            'email' => 'required|email',
            'cellphone' => 'nullable|max:12',
            'password' => 'required|max:125',
            'state_id' => 'required|integer'
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws UserRequestFailedException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new UserRequestFailedException($this->formatErrorsRequest($validator->errors()->all()), $this->badRequest());
    }
}
