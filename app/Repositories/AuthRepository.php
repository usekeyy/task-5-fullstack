<?php  

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;
use App\Traits\ResponseAPI;
use App\Models\User;

class AuthRepository implements AuthInterface
{
    use ResponseAPI;

    public function register(AuthRequest $request)
    {
        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->success("Regitrasi berhasil", $user, 201);
    }

    public function login(AuthRequest $request)
    {
        $user  = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error("Email yang anda masukkan belum terdaftar", 400);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return $this->error("Password yang anda masukkan salah", 400);
        }
        $token = $user->createToken('accessToken')->accessToken;
        $data = [
            'user'          => $user,
            'accessToken'   => $token,
        ];
        return $this->success("Selamat anda berhasil login", $data, 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user()->token()->revoke();
        return $this->success("Selamat anda berhasil logout", null, 200);
    }

}