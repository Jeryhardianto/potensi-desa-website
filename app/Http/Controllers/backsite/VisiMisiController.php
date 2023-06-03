<?php

namespace App\Http\Controllers\backsite;

use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function visi()
    {
        $visi = Visi::all();
        $misi = Misi::all();
        return view('pages.backsite.visimisi.index', compact('visi', 'misi'));
    }

    public function visi_update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'visi' => 'required',

        ],[
            'visi.required' =>  'Visi Wajib Diisi'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $visi = Visi::find($id);

        $visi->update([
            'visi' => $request->visi,
        ]);
        return response()->json($visi);
    }

    public function misi_add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'misi' => 'required'

        ],[
            'misi.required' =>  'Misi Wajib Diisi'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $misi = Misi::create([
            'misi' => $request->misi
        ]);
        return response()->json($misi);

    }


    public function misi_update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'misi' => 'required',

        ],[
            'misi.required' =>  'Misi Wajib Diisi'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $misi = Misi::find($id);

        $misi->update([
            'misi' => $request->misi,
        ]);
        return response()->json($misi);
    }

    
    public function destroy($id)
    {
        $misi = Misi::find($id);
        $misi->delete();
        
        return redirect()->back();
    }
}
