<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyewa;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
class PenyewaController extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $penyewa=DB::table('penyewa')
            ->where('penyewa.id',$id)
            ->get();
            return response()->json($penyewa);
        }else{
            return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required',
            'foto'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Penyewa::create([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'foto'=>$req->foto
        ]);
        $status=1;
        $message="Penyewa Berhasil Ditambahkan";
        if($simpan){
          return Response()->json(compact('status','message'));
        }else {
          return Response()->json(['status'=>0]);
        }
      }
      else {
          return response()->json(['status'=>'anda bukan admin']);
      }
  }
    public function update($id,Request $request){
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($request->all(),
            [
                'nama_penyewa'=>'required',
                'alamat'=>'required',
                'telp'=>'required',
                'no_ktp'=>'required',
                'foto'=>'required'
            ]
        );

        if($validator->fails()){
        return Response()->json($validator->errors());
        }

        $ubah=Penyewa::where('id',$id)->update([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$req->no_ktp,
            'foto'=>$req->foto
        ]);
        $status=1;
        $message="Penyewa Berhasil Diubah";
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
        $hapus=Penyewa::where('id',$id)->delete();
        $status=1;
        $message="Penyewa Berhasil Dihapus";
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
            $datas = Penyewa::get();
            $count = $datas->count();
            $penyewa = array();
            $status = 1;
            foreach ($datas as $dt_py){
                $penyewa[] = array(
                    'id' => $dt_py->id,
                    'nama_penyewa' => $dt_py->nama_penyewa,
                    'alamat' => $dt_py->alamat,
                    'telp' => $dt_py->telp,
                    'no_ktp' => $dt_py->no_ktp,
                    'foto' => $dt_py->foto

                );
            }
            return Response()->json(compact('count','penyewa'));
        } else {
            return Response()->json(['status'=> 'Tidak bisa, anda bukan admin']);
        }
    }
}
