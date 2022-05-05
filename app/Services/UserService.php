<?php

namespace App\Services;

use Exception;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Throwable;

class UserService
{

    protected $auth;

    public function __construct()
    {
        $this->auth = app('firebase.auth');
    }

    public function createUser($name, $email, $password)
    {
        try {
            $userData = [
                'email' => $email,
                'emailVerified' => false,
                'password' => $password,
                'displayName' => $name,
                'disabled' => false,
            ];
            return $this->auth->createUser($userData);
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return new \Exception($e->getMessage());
        }
    }
}
