<?php

namespace App\Http\Controllers\backsite;

use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Models\AnggotaPokTan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AnggotaPokTanController extends Controller
{
    public function index($id)
    {

        $anggotapoktan = AnggotaPokTan::where('id_poktan', $id)->get();
        $poktan        = KelompokTani::where('id', $id)->first();

        return view('pages.backsite.anggotapoktan.index', compact('anggotapoktan', 'poktan'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'status' => 'required|not_in:2'

        ],[
            'nama.required' =>  'Nama Wajib Diisi',
            'status.not_in' =>  'Status Wajib Diisi'
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $anggotapoktan = AnggotaPokTan::create([
            'id_poktan' => $request->id_poktan,
            'nama'      => $request->nama,
            'is_status'    => ($request->status == 1) ? true : false
        ]);
        return response()->json($anggotapoktan);
    }
    
    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'status' => 'required|not_in:2'

        ],[
            'nama.required' =>  'Nama Wajib Diisi',
            'status.not_in' =>  'Status Wajib Diisi'
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $anggotapoktan = AnggotaPokTan::find($id);

        $anggotapoktan->update([
            'nama'          => $request->nama,
            'is_status'     => ($request->status == 1) ? true : false
        ]);
        return response()->json($anggotapoktan);
    }

    public function destroy($id)
    {
        $anggotapoktan = AnggotaPokTan::find($id);
        $anggotapoktan->delete();
        
        return redirect()->back();
    }
}
