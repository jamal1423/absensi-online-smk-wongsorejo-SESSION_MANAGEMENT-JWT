<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\SessionController;

class AuthController extends Controller
{
    private $cekSession;
    public function __construct(SessionController $sessionController)
    {
        // $this->middleware('auth:web', ['except' => ['authenticate_admin','login_admin','logout']]);
        $this->cekSession = $sessionController;
    }

    public function login_admin(){
        $data = $this->cekSession->cek_session();
        // dd($data);
        if($data > 0){
            return view('admin.pages.dashboard');
            // return redirect('/dashboard');
        }else{
            return view('admin.pages.login-admin');
            // return redirect('/login');
        }
    }

    public function authenticate_admin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');

        $token = auth()->guard('web')->attempt($credentials);
        if (!$token) {
            return back()->with('loginError', 'Login gagal, ulangi lagi!');
        }

        if (auth()->guard('web')->check()) {
            $request->session()->regenerate();
            $request->session()->put('tokenJWT',$token);
            return redirect()->intended('/dashboard')->with(['statusLogin' => 'ok']);
        }else{
            return redirect()->intended('/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->put('tokenJWT','');
        return redirect('/login');
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => auth()->guard('web')->user(),
            'authorisation' => [
                'token' => auth()->guard('web')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
