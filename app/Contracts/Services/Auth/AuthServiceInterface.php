<?php

namespace App\Contracts\Services\Auth;

use App\Http\Requests\UserRegisterRequest;

/**
 * Interface for authentication service.
 */
interface AuthServiceInterface
{
    /**
     * To Save User with values from request
     * @param Request $request request including inputs
     * @return Object created user object
     */
    public function saveUser(UserRegisterRequest $request);

    /**
     * To Login the user
     * 
     * @param array $user input value
     * @param bool $remember me or not
     * @return bool loggedin or not
     */
    public function login($user, $remember);
}
