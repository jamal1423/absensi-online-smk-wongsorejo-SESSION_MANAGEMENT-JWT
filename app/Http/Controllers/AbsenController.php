<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Models\Absen;

class AbsenController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function data_kehadiran(){
        $data = $this->cekSession->cek_session();
        $dataUsername = $data['us2'];
        if(isset($data['us1']) > 0){
            try{
                $dataKehadiran = Absen::select('absen.*', 'siswa.nis', 'siswa.username', 'siswa.nama as nama_siswa', 'siswa.kelas', 'siswa.foto')
                ->join('siswa', 'siswa.username', '=', 'absen.userlog')
                ->paginate(50);
                return view('admin.pages.data-kehadiran',[
                    'dataKehadiran' => $dataKehadiran,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-kehadiran')->with(['absensiError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }
}
