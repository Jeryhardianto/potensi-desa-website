<?php

namespace App\Http\Controllers\backsite;


use App\Models\DataPenduduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataPendudukController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $dataPenduduks = DataPenduduk::orderBy('created_at', 'desc')->get();
        return view('pages.backsite.datapenduduk.index', compact('dataPenduduks'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'no_kk' => 'required|unique:data_penduduks,no_kk',
            'kode_rt' => 'required|not_in:0',
            'kk' => 'required',
            'alamat' => 'required',

        ],[
            'no_kk.required' => 'Nomor Kartu Keluarga Wajib Diisi',
            'no_kk.unique' => 'Nomor Kartu Keluarga Ini Sudah Tersedia',
            'kode_rt.required' =>  'Kode RT Wajib Diisi',
            'kode_rt.not_in' =>  'Kode RT Wajib Diisi',
            'kk.required' =>  'Kepala Keluarga Wajib Diisi',
            'alamat.required' =>  'Alamat Wajib Diisi'
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $dataPenduduk = DataPenduduk::create([
            'no_kk' => $request->no_kk,
            'kode_rt' => $request->kode_rt,
            'kepala_keluarga' => $request->kk,
            'alamat' => $request->alamat,
            'provinsi' => $request->prov,
            'kabupaten' => $request->kab,
            'kecamatan' => $request->kec,
            'kode_pos' => $request->kodepos
        ]);
        return response()->json($dataPenduduk);

    }


 
    public function update(Request $request, $id)
    {
      

        $validator = Validator::make($request->all(), [
            'no_kk' => 'required',
            'kode_rt' => 'required|not_in:0',
            'kk' => 'required',
            'alamat' => 'required',

        ],[
            'no_kk.required' => 'Nomor Kartu Keluarga Wajib Diisi',
            'kode_rt.required' =>  'Kode RT Wajib Diisi',
            'kode_rt.not_in' =>  'Kode RT Wajib Diisi',
            'kk.required' =>  'Kepala Keluarga Wajib Diisi',
            'alamat.required' =>  'Alamat Wajib Diisi'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $dataPenduduk = DataPenduduk::find($id);

        $dataPenduduk->update([
            'no_kk' => $request->no_kk,
            'kode_rt' => $request->kode_rt,
            'kepala_keluarga' => $request->kk,
            'alamat' => $request->alamat,
            'provinsi' => $request->prov,
            'kabupaten' => $request->kab,
            'kecamatan' => $request->kec,
            'kode_pos' => $request->kodepos
        ]);
        return response()->json($dataPenduduk);
    }

    public function destroy($id)
    {
        $dataPenduduk = DataPenduduk::find($id);
        $dataPenduduk->delete();
        
        return redirect()->back();
    }
}
