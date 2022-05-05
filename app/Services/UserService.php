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

    public function createUser($userData)
    { 
        // return $this->auth->createUserWithEmailAndPassword($userData); 
    }
    
    public function checkEmailExist($email) 
    {
        return $this->auth->getUserByEmail($email) ?? true;
    }
}
