<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\SessionController;

class DashboardController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function halaman_dashboard(){
        $data = $this->cekSession->cek_session();
        if($data > 0){
            return view('admin.pages.dashboard');
            // return redirect('/dashboard');
        }else{
            return view('admin.pages.login-admin');
            // return redirect('/login');
        }
    }
}
