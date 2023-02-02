<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function data_lokasi(){
        $data = $this->cekSession->cek_session();
        if($data > 0){
            try{
                $dataLokasi = Lokasi::paginate(10);
                return view('admin.pages.data-lokasi',[
                    'dataLokasi' => $dataLokasi,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-lokasi')->with(['lokasiError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_lokasi_add(Request $request){
        $data = $this->cekSession->cek_session();
        if($data > 0){
            try {
                $validatedData = $request->validate([
                    'nama' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'radius' => 'required',
                ]);
    
                Lokasi::create($validatedData);
                return redirect('/data-lokasi')->with(['lokasiTambah' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-lokasi')->with(['lokasiError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }
}
