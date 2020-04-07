<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class PetugasController extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $petugas=DB::table('petugas')
            ->where('petugas.id',$id)
            ->get();
            return response()->json($petugas);
        }else{
            return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:255',
            'level' => 'required',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Petugas::create([
            'nama_petugas' => $request->get('nama_petugas'),
            'alamat' => $request->get('alamat'),
            'telp' => $request->get('telp'),
            'level' => $request->get('level'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
    public function update($id,Request $request){
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($request->all(),
            [
                'nama_petugas'=>'required',
                'alamat'=>'required',
                'telp'=>'required',
                'level'=>'required',
                'username'=>'required',
                'password'=>'required'
            ]
        );

        if($validator->fails()){
        return Response()->json($validator->errors());
        }

        $ubah=Petugas::where('id',$id)->update([
            'nama_petugas'=>$request->nama_petugas,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
            'level'=>$request->level,
            'username'=>$request->username,
            'password'=>$request->password
        ]);
        $status=1;
        $message="Petugas Berhasil Diubah";
        if($ubah){
        return Response()->json(compact('status','message'));
        }else {
        return Response()->json(['status'=>0]);
        }
        }
    else {
    return response()->json(['status'=>'anda bukan admin']);
    }
}
    public function destroy($id){
        if(Auth::user()->level=="admin"){
        $hapus=Petugas::where('id',$id)->delete();
        $status=1;
        $message="Petutgas Berhasil Dihapus";
        if($hapus){
        return Response()->json(compact('status','message'));
        }else {
        return Response()->json(['status'=>0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
        }
    }
  
    public function tampil(){
        if(Auth::user()->level=="admin"){
            $datas = Petugas::get();
            $count = $datas->count();
            $petugas = array();
            $status = 1;
            foreach ($datas as $dt_pt){
                $petugas[] = array(
                    'id' => $dt_pt->id,
                    'nama_petugas' => $dt_pt->nama_petugas,
                    'alamat' => $dt_pt->alamat,
                    'telp' => $dt_pt->telp,
                    'level' => $dt_pt->level,
                    'username' => $dt_pt->username,
                    'password' => $dt_pt->password

                );
            }
            return Response()->json(compact('count','petugas'));
        } else {
            return Response()->json(['status'=> 'Tidak bisa, anda bukan admin']);
        }
    }
}


