<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\UserService;

class EmailAlreadyExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userService = new UserService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (!$this->userService->checkEmailExist($value)); 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':Attribute already in use.';
    }
}
