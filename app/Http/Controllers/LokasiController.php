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
        if(isset($data['us1']) > 0){
            try{
                $mapApiKey=env('GOOGLE_MAP_API_KEY');
                $dataLokasi = Lokasi::paginate(10);
                return view('admin.pages.data-lokasi',[
                    'dataLokasi' => $dataLokasi,
                    'mapApiKey' => $mapApiKey,
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
        if(isset($data['us1']) > 0){
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
    
    public function data_lokasi_edit(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'nama' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'radius' => 'required',
                ]);
    
                Lokasi::where('id', $request->id)
                ->update($validatedData);
                return redirect('/data-lokasi')->with(['lokasiEdit' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-lokasi')->with(['lokasiError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_lokasi_delete(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                Lokasi::destroy($request->id_del);
                return redirect('/data-lokasi')->with(['lokasiDelete' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-lokasi')->with(['lokasiError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function get_data_lokasi($id){
        $getID = base64_decode($id);
        $dataLokasi = Lokasi::findOrFail($getID);
        return response()->json([
            'dataLokasi' => $dataLokasi,
        ]);
    }
}
