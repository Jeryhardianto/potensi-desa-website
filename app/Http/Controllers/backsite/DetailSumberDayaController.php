<?php

namespace App\Http\Controllers\backsite;

use Illuminate\Http\Request;
use App\Models\DataSumberDaya;
use App\Http\Controllers\Controller;
use App\Models\DetailDataSumberDaya;
use Illuminate\Support\Facades\Validator;

class DetailSumberDayaController extends Controller
{
    public function index($id)
    {

        $sumberdaya          = DataSumberDaya::where('id', $id)->first();
        $detailsumberdaya    = DetailDataSumberDaya::where('id_sumber_daya', $id)->get();

        return view('pages.backsite.detailsumberdaya.index', compact('sumberdaya', 'detailsumberdaya'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pemilik'           => 'required',
            'alamat'            => 'required',
            'masapanen'         => 'required',
            'satuanpanen'       => 'required',
            'jumlah_hasil'      => 'required',
            'satuan_hasil'      => 'required',
            'jumlah_anggota'    => 'required',
            'luas'              => 'required',
            'satuanluas'        => 'required',

        ],[
            'pemilik.required'          =>  'Pemilik Wajib Diisi',
            'alamat.required'           =>  'Alamat Wajib Diisi',
            'masapanen.required'        =>  'Masa Panen Wajib Diisi',
            'satuanpanen.required'      =>  'Satuan Panen Wajib Diisi',
            'jumlah_hasil.required'     =>  'Jumlah Hasil Wajib Diisi',
            'satuan_hasil.required'     =>  'Satuan Hasil Wajib Diisi',
            'jumlah_anggota.required'   =>  'Jumlah Anggota Wajib Diisi',
            'luas.required'             =>  'Luas Wajib Diisi',
            'satuanluas.required'       =>  'Satuan Luas Wajib Diisi',
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $detailsumberdaya = DetailDataSumberDaya::create([
            'id_sumber_daya' => $request->id_sumberdaya,
            'pemilik' => $request->pemilik,
            'alamat' => $request->alamat,
            'masa_panen' => $request->masapanen,
            'satuan_panen' => $request->satuanpanen,
            'jumlah_hasil' => $request->jumlah_hasil,
            'satuan_hasil' => $request->satuan_hasil,
            'jumlah_anggota' => $request->jumlah_anggota,
            'luas' => $request->luas,
            'satuan_luas' => $request->satuanluas,
        
        ]);
        return response()->json($detailsumberdaya);
    }
    
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'pemilik'           => 'required',
            'alamat'            => 'required',
            'masapanen'         => 'required',
            'satuanpanen'       => 'required',
            'jumlah_hasil'      => 'required',
            'satuan_hasil'      => 'required',
            'jumlah_anggota'    => 'required',
            'luas'              => 'required',
            'satuanluas'        => 'required',

        ],[
            'pemilik.required'          =>  'Pemilik Wajib Diisi',
            'alamat.required'           =>  'Alamat Wajib Diisi',
            'masapanen.required'        =>  'Masa Panen Wajib Diisi',
            'satuanpanen.required'      =>  'Satuan Panen Wajib Diisi',
            'jumlah_hasil.required'     =>  'Jumlah Hasil Wajib Diisi',
            'satuan_hasil.required'     =>  'Satuan Hasil Wajib Diisi',
            'jumlah_anggota.required'   =>  'Jumlah Anggota Wajib Diisi',
            'luas.required'             =>  'Luas Wajib Diisi',
            'satuanluas.required'       =>  'Satuan Luas Wajib Diisi',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $detailsumberdaya = DetailDataSumberDaya::find($id);

        $detailsumberdaya->update([
            'pemilik' => $request->pemilik,
            'alamat' => $request->alamat,
            'masa_panen' => $request->masapanen,
            'satuan_panen' => $request->satuanpanen,
            'jumlah_hasil' => $request->jumlah_hasil,
            'satuan_hasil' => $request->satuan_hasil,
            'jumlah_anggota' => $request->jumlah_anggota,
            'luas' => $request->luas,
            'satuan_luas' => $request->satuanluas,
        ]);
        return response()->json($detailsumberdaya);
    }

    public function destroy($id)
    {
        $detailsumberdaya = DetailDataSumberDaya::find($id);
        $detailsumberdaya->delete();
        
        return redirect()->back();
    }
}
