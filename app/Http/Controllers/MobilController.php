<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
class MobilController extends Controller
{
    public function index($id)
    {
        if(Auth::user()->level=="admin"){
            $mobil=DB::table('mobil')
            ->where('mobil.id',$id)
            ->get();
            return response()->json($mobil);
        }else{
            return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'plat_mobil'=>'required',
            'merk'=>'required',
            'foto'=>'required',
            'keterangan'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Mobil::create([
            'plat_mobil'=>$req->plat_mobil,
            'merk'=>$req->merk,
            'foto'=>$req->foto,
            'keterangan'=>$req->keterangan
        ]);
        $status=1;
        $message="Mobil Berhasil Ditambahkan";
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
                'plat_mobil'=>'required',
                'merk'=>'required',
                'foto'=>'required',
                'keterangan'=>'required'
            ]
        );

        if($validator->fails()){
        return Response()->json($validator->errors());
        }

        $ubah=Mobil::where('id',$id)->update([
            'plat_mobil'=>$request->plat_mobil,
            'merk'=>$request->merk,
            'foto'=>$request->foto,
            'keterangan'=>$request->keterangan
        ]);
        $status=1;
        $message="Mobil Berhasil Diubah";
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
        $hapus=Mobil::where('id',$id)->delete();
        $status=1;
        $message="Mobil Berhasil Dihapus";
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
            $datas = Mobil::get();
            $count = $datas->count();
            $mobil = array();
            $status = 1;
            foreach ($datas as $dt_mo){
                $mobil[] = array(
                    'id' => $dt_mo->id,
                    'plat_mobil' => $dt_mo->plat_mobil,
                    'merk' => $dt_mo->merk,
                    'foto' => $dt_mo->foto,
                    'keterangan' => $dt_mo->keterangan

                );
            }
            return Response()->json(compact('count','mobil'));
        } else {
            return Response()->json(['status'=> 'Tidak bisa, anda bukan admin']);
        }
    }
}
