<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    private $cekSession;
    
    public function __construct(SessionController $sessionController)
    {
        $this->cekSession = $sessionController;
    }

    public function data_admin(){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try{
                $dataAdmin = User::paginate(10);
                return view('admin.pages.data-admin',[
                    'dataAdmin' => $dataAdmin,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-admin')->with(['adminError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_admin_add(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'username' => 'required|unique:users',
                    'password' => 'required',
                    'nama' => 'required',
                    'role' => 'required',
                    'foto' => '',
                ]);

                $cekExist = User::where('username',$request->username)->count();
                if($cekExist > 0){
                    return redirect('/data-admin')->with(['adminAlready' => 'ok']);
                }

                if ($request->hasFile('foto')) {
                    $image = $request->file('foto');
                    $name = date('mdYHis') . uniqid() . $image->getClientOriginalName();
                    $image->move(public_path() . '/foto-admin/', $name);
                    $validatedData['foto'] = $name;
                }

                $validatedData['password'] = bcrypt($validatedData['password']);
    
                User::create($validatedData);
                return redirect('/data-admin')->with(['adminTambah' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-admin')->with(['adminError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_admin_edit (Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $validatedData = $request->validate([
                    'username' => 'required',
                    'nama' => 'required',
                    'role' => 'required',
                    'foto' => '',
                ]);

                if ($request->hasFile('foto')) {
                    if ($request->oldImage) {
                        $gmbr = $request->oldImage;
                        $image_path = public_path() . '/foto-admin/' . $gmbr;
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }
    
                    $image = $request->file('foto');
                    $name = date('mdYHis') .'-'. uniqid() .'-'. $image->getClientOriginalName();
                    $image->move(public_path() . '/foto-admin/', $name);
                    $validatedData['foto'] = $name;
                }

                // if($request->password != ''){
                //     $validatedData['password'] = bcrypt($validatedData['password']);
                // }
    
                User::where('id', $request->id)
                ->update($validatedData);
                return redirect('/data-admin')->with(['adminEdit' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-admin')->with(['adminError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function data_admin_delete(Request $request){
        $data = $this->cekSession->cek_session();
        if(isset($data['us1']) > 0){
            try {
                $gmbr = $request->oldImageDel;
                $image_path = public_path() . '/foto-admin/' . $gmbr;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                User::destroy($request->id_del);
                return redirect('/data-admin')->with(['adminDelete' => 'ok']);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/data-admin')->with(['adminError' => 'ok']);
            }
        }else{
            return view('admin.pages.login-admin');
        }
    }

    public function get_data_admin($id){
        $getID = base64_decode($id);
        $dataAdmin = User::findOrFail($getID);
        return response()->json([
            'dataAdmin' => $dataAdmin,
        ]);
    }
}
