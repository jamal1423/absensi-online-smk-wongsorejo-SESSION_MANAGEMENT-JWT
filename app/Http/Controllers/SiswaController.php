<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\Siswa;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function data_siswa(){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try{
                $dataSiswa = Siswa::paginate(10);
                $dataKelas = Kelas::all();
                $dataLokasi = Lokasi::all();
                return view('admin.pages.data-siswa',[
                    'dataSiswa' => $dataSiswa,
                    'dataKelas' => $dataKelas,
                    'dataLokasi' => $dataLokasi,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-siswa')->with(['siswaError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_siswa_add(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'nama' => 'required',
                    'nis' => 'required|unique:siswa',
                    'kelas' => 'required',
                    'angkatan' => 'required',
                    'telp' => 'required',
                    'lokasi' => 'required',
                    'foto' => '',
                    'alamat' => 'required',
                    'tgl_lahir' => 'required',
                    'jk' => 'required',
                    'username' => 'required',
                    'password' => 'required',
                ]);

                $cekExist = Siswa::where('nis',$request->nis)->count();
                if($cekExist > 0){
                    return redirect('/data-siswa')->with(['nisAlready' => 'ok']);
                }

                if ($request->hasFile('foto')) {
                    $image = $request->file('foto');
                    $name = date('mdYHis') . uniqid() . $image->getClientOriginalName();
                    $image->move(public_path() . '/foto-siswa/', $name);
                    $validatedData['foto'] = $name;
                }

                $validatedData['password'] = bcrypt($validatedData['password']);
    
                Siswa::create($validatedData);
                return redirect('/data-siswa')->with(['siswaTambah' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-siswa')->with(['siswaError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_siswa_edit (Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'nama' => 'required',
                    'nis' => 'required',
                    'kelas' => 'required',
                    'angkatan' => 'required',
                    'telp' => 'required',
                    'lokasi' => 'required',
                    'foto' => '',
                    'alamat' => 'required',
                    'tgl_lahir' => 'required',
                ]);

                if ($request->hasFile('foto')) {
                    if ($request->oldImage) {
                        $gmbr = $request->oldImage;
                        $image_path = public_path() . '/foto-siswa/' . $gmbr;
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }
    
                    $image = $request->file('foto');
                    $name = date('mdYHis') .'-'. uniqid() .'-'. $image->getClientOriginalName();
                    $image->move(public_path() . '/foto-siswa/', $name);
                    $validatedData['foto'] = $name;
                }
    
                Siswa::where('id', $request->id)
                ->update($validatedData);
                return redirect('/data-siswa')->with(['siswaEdit' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-siswa')->with(['siswaError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_siswa_delete(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $gmbr = $request->oldImageDel;
                $image_path = public_path() . '/foto-siswa/' . $gmbr;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                Siswa::destroy($request->id_del);
                return redirect('/data-siswa')->with(['siswaDelete' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-siswa')->with(['siswaError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function get_data_siswa($id){
        $getID = base64_decode($id);
        $dataSiswa = Siswa::findOrFail($getID);
        $dataKelas = Kelas::all();
        $dataLokasi = Lokasi::all();
        return response()->json([
            'dataSiswa' => $dataSiswa,
            'dataKelas' => $dataKelas,
            'dataLokasi' => $dataLokasi,
        ]);
    }
}
