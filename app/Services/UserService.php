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
        $dataUser = [
            'email' => $email,
            'emailVerified' => false,
            'password' => $password,
            'displayName' => $name,
            'disabled' => false,
        ];
        return $this->auth->createUser($dataUser);
    }

    public function checkEmailExist($email)
    {
        try {
            $getUser = $this->getUserByEmail($email);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        return $this->auth->getUserByEmail($email);
    }

    public function signInWithEmailandPassword($email, $password)
    {
        return $this->auth->signInWithEmailandPassword($email, $password);
    }
}
