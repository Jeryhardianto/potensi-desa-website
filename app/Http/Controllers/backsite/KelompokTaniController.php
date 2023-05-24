<?php

namespace App\Http\Controllers\backsite;

use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelompokTaniController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $kelompoktanis = KelompokTani::orderBy('created_at', 'desc')->get();
        return view('pages.backsite.kelompoktani.index', compact('kelompoktanis'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_poktan' => 'required',
            'ketua' => 'required'

        ],[
            'nama_poktan.required' =>  'Nama Kelompok Tani Wajib Diisi',
            'ketua.required' =>  'Nama Ketua Wajib Diisi'
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $kelompoktani = KelompokTani::create([
            'nama_poktan' => $request->nama_poktan,
            'ketua_poktan' => $request->ketua
        ]);
        return response()->json($kelompoktani);

    }


 
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'nama_poktan' => 'required',
            'ketua' => 'required'

        ],[
            'nama_poktan.required' =>  'Nama Kelompok Tani Wajib Diisi',
            'ketua.required' =>  'Nama Ketua Wajib Diisi'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $kelompoktani = KelompokTani::find($id);

        $kelompoktani->update([
            'nama_poktan' => $request->nama_poktan,
            'ketua_poktan' => $request->ketua
        ]);
        return response()->json($kelompoktani);
    }

    public function destroy($id)
    {
        $kelompoktani = KelompokTani::find($id);
        $kelompoktani->delete();
        
        return redirect()->back();
    }
}
