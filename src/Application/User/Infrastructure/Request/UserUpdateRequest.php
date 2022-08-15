<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Src\Application\User\Domain\Exceptions\UserRequestFailedException;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class UserUpdateRequest extends FormRequest
{
    use RequestHelper;

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'user_name' => 'nullable|max:45',
            'first_name' => 'nullable|max:45',
            'second_name' => 'nullable|max:45',
            'first_last_name' => 'nullable|max:45',
            'second_last_name' => 'nullable|max:45',
            'email' => 'nullable|email',
            'cellphone' => 'nullable|max:12',
            'password' => 'nullable|max:125',
            'state_id' => 'nullable|integer'
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws UserRequestFailedException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new UserRequestFailedException($this->formatErrorsRequest($validator->errors()->all()), 400);
    }
}
