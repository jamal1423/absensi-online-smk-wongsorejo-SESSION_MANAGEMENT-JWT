<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function cek_session(){
        try{
            $token = session()->get('tokenJWT');
            if($token != ""){
                $tokenParts = explode(".", $token); 
                $tokenHeader = base64_decode($tokenParts[0]);
                $tokenPayload = base64_decode($tokenParts[1]);

                $jwtHeader = json_decode($tokenHeader);
                $jwtPayload = json_decode($tokenPayload);
                
                $username = base64_decode($jwtPayload->unm);
                $nama = base64_decode($jwtPayload->nm);
                $role = base64_decode($jwtPayload->role);
                
                $cekUser = User::where('username','=',$username)
                ->where('role','=',$role)->count();
                
                return $cekUser;
            }else{
                return false;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
}
