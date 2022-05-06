<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\UserService;
use App\Rules\EmailAlreadyExistRule;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    protected $userService;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
        $this->userService = new UserService;
    }

    protected function register(RegisterRequest $request)
    {
        try {
            $createdUser = $this->userService->createUser($request->name, $request->email, $request->password);
            return redirect()->route('login')->with('status', 'Successfully registered');
        } catch (\Exception $e) {
            $errorCode = $e->getCode();

            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}
