<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getData(){
        $data = DB::table('tbl_katalog')->get();

        // cek kondisi
        if (count($data) > 0) {
            $res['message'] = "Success!!";
            $res['value'] = $data;
            return response($res);
        }else{
            $res['message'] = "Empty!!";
            return response($res);
        }
    }
}
