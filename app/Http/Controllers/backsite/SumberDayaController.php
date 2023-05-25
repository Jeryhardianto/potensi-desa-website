<?php

namespace App\Http\Controllers\backsite;

use Illuminate\Http\Request;
use App\Models\DataSumberDaya;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SumberDayaController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $sumberdayas = DataSumberDaya::orderBy('created_at', 'desc')->get();
        return view('pages.backsite.sumberdaya.index', compact('sumberdayas'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_sumber_daya' => 'required',
            'namasuberdaya' => 'required',
            'keterangan' => 'required',

        ],[
            'kode_sumber_daya.required' =>  'Kode Sumber Daya Wajib Diisi',
            'namasuberdaya.required' =>  'Nama Sumber Daya Wajib Diisi',
            'keterangan.required' =>  'Keterangan Wajib Diisi'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $sumberdaya = DataSumberDaya::create([
            'kode_sumber_daya' => $request->kode_sumber_daya,
            'nama_sumber_daya' => $request->namasuberdaya,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json($sumberdaya);

    }


    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'kode_sumber_daya' => 'required',
            'namasuberdaya' => 'required',
            'keterangan' => 'required',

        ],[
            'kode_sumber_daya.required' =>  'Kode Sumber Daya Wajib Diisi',
            'namasuberdaya.required' =>  'Nama Sumber Daya Wajib Diisi',
            'keterangan.required' =>  'Keterangan Wajib Diisi'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $sumberdaya = DataSumberDaya::find($id);

        $sumberdaya->update([
            'kode_sumber_daya' => $request->kode_sumber_daya,
            'nama_sumber_daya' => $request->namasuberdaya,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json($sumberdaya);
    }

    public function destroy($id)
    {
        $sumberdaya = DataSumberDaya::find($id);
        $sumberdaya->delete();
        
        return redirect()->back();
    }
}
