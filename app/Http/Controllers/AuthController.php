<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    protected $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function register(AuthRequest $request)
    {
        return $this->authInterface->register($request);
    }

    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authInterface->logout($request);
    }
}
