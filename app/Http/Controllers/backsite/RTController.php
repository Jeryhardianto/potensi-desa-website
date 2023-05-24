<?php

namespace App\Http\Controllers\backsite;

use App\Models\DataRT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RTController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $rts = DataRT::orderBy('created_at', 'desc')->get();
        return view('pages.backsite.rt.index', compact('rts'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_rt' => 'required',
            'nama_rt' => 'required',
            'keterangan' => 'required',

        ],[
            'kode_rt.required' =>  'Kode RT Wajib Diisi',
            'nama_rt.required' =>  'Nama RT Wajib Diisi',
            'keterangan.required' =>  'Keterangan Wajib Diisi'
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $dataRT = DataRT::create([
            'kode_rt' => $request->kode_rt,
            'nama_rt' => $request->nama_rt,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json($dataRT);

    }


 
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'kode_rt' => 'required',
            'nama_rt' => 'required',
            'keterangan' => 'required',

        ],[
            'kode_rt.required' =>  'Kode RT Wajib Diisi',
            'nama_rt.required' =>  'Nama RT Wajib Diisi',
            'keterangan.required' =>  'Keterangan Wajib Diisi'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $datart = DataRT::find($id);

        $datart->update([
            'kode_rt' => $request->kode_rt,
            'nama_rt' => $request->nama_rt,
            'keterangan' => $request->keterangan,
        ]);
        return response()->json($datart);
    }

    public function destroy($id)
    {
        $datart = DataRT::find($id);
        $datart->delete();
        
        return redirect()->back();
    }
}
