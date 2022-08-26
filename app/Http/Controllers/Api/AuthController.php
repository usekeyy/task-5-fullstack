<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Repositories\AuthRepository;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    protected $authInterface;

    public function __construct(AuthRepository $authInterface)
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
