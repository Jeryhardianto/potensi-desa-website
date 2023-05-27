<?php

namespace App\Http\Controllers\backsite;

use Illuminate\Http\Request;
use App\Models\DataSumberDaya;
use App\Models\DataHasilSumberDaya;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HasilSumberDayaController extends Controller
{
    public function index()
    {

        $sumberdayas            = DataSumberDaya::orderBy('created_at', 'desc')->get();
        $dataHasilSumberDaya    = DataHasilSumberDaya::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.hasilsumberdaya.index', compact('dataHasilSumberDaya', 'sumberdayas'));
    }

    public function store(Request $request)
    {
   

        $validator = Validator::make($request->all(), [
            'sumber_daya'       => 'required|not_in:0',
            'periodeawal'       => 'required',
            'periodeakhir'      => 'required',
            'masapanen'         => 'required',
            'satuanpanen'       => 'required',
            'jumlah_hasil'      => 'required',
            'satuan_hasil'      => 'required',
            'jumlah_anggota'    => 'required',
            'luas'              => 'required',
            'satuanluas'        => 'required',

        ],[
            'sumber_daya.required'          =>  'Sumber Daya Wajib Diisi',
            'sumber_daya.not_in'            =>  'Sumber Daya Wajib Diisi',
            'periodeawal.required'          =>  'Periode Awal Wajib Diisi',
            'periodeakhir.required'         =>  'Periode Akhir Wajib Diisi',
            'masapanen.required'            =>  'Masa Panen Wajib Diisi',
            'satuanpanen.required'          =>  'Satuan Panen Wajib Diisi',
            'jumlah_hasil.required'         =>  'Jumlah Hasil Wajib Diisi',
            'satuan_hasil.required'         =>  'Satuan Hasil Wajib Diisi',
            'jumlah_anggota.required'       =>  'Jumlah Anggota Wajib Diisi',
            'luas.required'                 =>  'Luas Wajib Diisi',
            'satuanluas.required'           =>  'Satuan Luas Wajib Diisi',
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $datasumberdaya = DataHasilSumberDaya::create([
            'id_sumber_daya'    => $request->sumber_daya,
            'periode_awal'      => $request->periodeawal,
            'periode_akhir'     => $request->periodeakhir,
            'masa_panen'        => $request->masapanen,
            'satuan_panen'      => $request->satuanpanen,
            'jumlah_hasil'      => $request->jumlah_hasil,
            'satuan_hasil'      => $request->satuan_hasil,
            'jumlah_anggota'    => $request->jumlah_anggota,
            'luas'              => $request->luas,
            'satuan_luas'       => $request->satuanluas,
        
        ]);
        return response()->json($datasumberdaya);
    }
    
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'sumber_daya'       => 'required|not_in:0',
            'periodeawal'       => 'required',
            'periodeakhir'      => 'required',
            'masapanen'         => 'required',
            'satuanpanen'       => 'required',
            'jumlah_hasil'      => 'required',
            'satuan_hasil'      => 'required',
            'jumlah_anggota'    => 'required',
            'luas'              => 'required',
            'satuanluas'        => 'required',

        ],[
            'sumber_daya.required'          =>  'Sumber Daya Wajib Diisi',
            'sumber_daya.not_in'            =>  'Sumber Daya Wajib Diisi',
            'periodeawal.required'          =>  'Periode Awal Wajib Diisi',
            'periodeakhir.required'         =>  'Periode Akhir Wajib Diisi',
            'masapanen.required'            =>  'Masa Panen Wajib Diisi',
            'satuanpanen.required'          =>  'Satuan Panen Wajib Diisi',
            'jumlah_hasil.required'         =>  'Jumlah Hasil Wajib Diisi',
            'satuan_hasil.required'         =>  'Satuan Hasil Wajib Diisi',
            'jumlah_anggota.required'       =>  'Jumlah Anggota Wajib Diisi',
            'luas.required'                 =>  'Luas Wajib Diisi',
            'satuanluas.required'           =>  'Satuan Luas Wajib Diisi',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $datasumberdaya = DataHasilSumberDaya::find($id);

        $datasumberdaya->update([
            'id_sumber_daya'    => $request->sumber_daya,
            'periode_awal'      => $request->periodeawal,
            'periode_akhir'     => $request->periodeakhir,
            'masa_panen'        => $request->masapanen,
            'satuan_panen'      => $request->satuanpanen,
            'jumlah_hasil'      => $request->jumlah_hasil,
            'satuan_hasil'      => $request->satuan_hasil,
            'jumlah_anggota'    => $request->jumlah_anggota,
            'luas'              => $request->luas,
            'satuan_luas'       => $request->satuanluas,
        ]);
        return response()->json($datasumberdaya);
    }

    public function destroy($id)
    {
        $datasumberdaya = DataHasilSumberDaya::find($id);
        $datasumberdaya->delete();
        
        return redirect()->back();
    }
}
