<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\SessionController;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\Siswa;

class DashboardController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function halaman_dashboard(){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            return view('admin.pages.dashboard');
            // return redirect('/dashboard');
        }else{
            return view('admin.pages.login-admin');
            // return redirect('/login');
        }
    }

    public function get_data_header(){
        $data = $this->cekSession->cek_session();
        $dataUsername = $data['us2'];
        if(isset($data['us1']) > 0){
            $dataUser = User::where('username','=',$dataUsername->username)->first();
            $totalKelas =  Kelas::count();
            $totalSiswa = Siswa::count();
            $totalLokasi = Lokasi::count();
            return response()->json([
                'dataUser' => $dataUser,
                'totalKelas' => $totalKelas,
                'totalSiswa' => $totalSiswa,
                'totalLokasi' => $totalLokasi,
            ]);
        }else{
            return false;
        }
    }
}
