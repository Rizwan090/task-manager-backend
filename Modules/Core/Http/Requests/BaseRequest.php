<?php

namespace Modules\Core\Http\Requests;

use Modules\Core\DataTransfer\DTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Modules\Core\Exceptions\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    final protected function failedValidation(Validator $validator): void
    {
        throw (new ValidationException($validator))->errorBag($this->errorBag);
    }

    /**
     * @return string
     */
    final protected function generateRandomPassword() : string{
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    abstract public function getDTO(): DTO;
}
