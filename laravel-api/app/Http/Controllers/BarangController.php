<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\tbl_katalog;
class BarangController extends Controller
{
    public function getData(){
        $data = DB::table('tbl_katalog')->get();

        // cek kondisi
        if (count($data) > 0) {
            $res['message'] = "Success!!";
            $res['values'] = $data;
            return response($res);
        }else{
            $res['message'] = "Empty!!";
            return response($res);
        }
    }
    public function store(Request $request){
        $this->validate($request,[
            'file'=>'required|max:2048'
        ]);

        // menyimpan data file yang diupload ke variabel file 
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();

        // isi dengan mana folder tempat kemana file di upload
        $tujuan_upload = 'data_file';
        if ($file->move($tujuan_upload, $nama_file)) {
            $data = tbl_katalog::create([
                'nama_produk' => $request->nama_produk,
                'berat' => $request->berat,
                'harga' => $request->harga,
                'gambar' => $request->gambar,
                'keterangan' => $request->keterangan,
            ]);
            $res['message'] = "Success!!";
            $res['values'] = $data;
            return response($res);
        }else{
            $res['message'] = "error!!!";
            return response($res);
        }
    }
}
