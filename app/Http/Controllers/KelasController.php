<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;

class KelasController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function data_kelas(){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try{
                $dataKelas = Kelas::orderBy('kelas')->paginate(10);
                return view('admin.pages.data-kelas',[
                    'dataKelas' => $dataKelas
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-kelas')->with(['kelasError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_kelas_add(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'kelas' => 'required|unique:kelas',
                ]);
    
                Kelas::create($validatedData);
                return redirect('/data-kelas')->with(['kelasTambah' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-kelas')->with(['kelasError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_kelas_edit(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'kelas' => 'required|unique:kelas',
                ]);
    
                Kelas::where('id', $request->id)
                ->update($validatedData);
                return redirect('/data-kelas')->with(['kelasEdit' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-kelas')->with(['kelasError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_kelas_delete(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                Kelas::destroy($request->id_del);
                return redirect('/data-kelas')->with(['kelasDelete' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-kelas')->with(['kelasError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function get_data_kelas($id){
        $getID = base64_decode($id);
        $dataKelas = Kelas::findOrFail($getID);
        return response()->json([
            'dataKelas' => $dataKelas
        ]);
    }
}
