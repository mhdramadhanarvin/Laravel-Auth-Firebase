<?php

namespace App\Repository;

use Kreait\Firebase\Auth as FirebaseAuth;

class AddUserFirebaseRepository
{
    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }
}
