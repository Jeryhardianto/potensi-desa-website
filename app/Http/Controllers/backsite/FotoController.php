<?php

namespace App\Http\Controllers\backsite;

use App\Models\Foto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FotoController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $fotos = Foto::all();
        return view('pages.backsite.foto.index', compact('fotos'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:2048'

        ],[
            'judul.required' =>  'Judul Wajib Diisi',
            'foto.required' =>  'Foto Wajib Diisi',
            'foto.mimes' =>  'Foto Wajib Berekstensi .jpg, .png, .jpeg',
            'foto.max' =>  'Foto Wajib Maximum 2 MB',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $file = $request->file('foto');

        $path = $file->store('public/files');
        $url = Storage::url($path);

        $foto = Foto::create([
            'judul' => $request->judul,
            'image' => $url
        ]);
        return response()->json($foto);

    }

    public function update(Request $request, $id)
    {
      
      
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'foto' => 'mimes:jpg,png,jpeg|max:2048'

        ],[
            'judul.required' =>  'Judul Wajib Diisi',
            'foto.mimes' =>  'Foto Wajib Berekstensi .jpg, .png, .jpeg',
            'foto.max' =>  'Foto Wajib Maximum 2 MB',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $foto = Foto::find($id);

        $file = $request->file('foto');

        if($file)
        {
            $path = $file->store('public/files');
            $url = Storage::url($path);
    
            $foto->update([
                'judul' => $request->judul,
                'image' => $url
            ]);
        }else{
            $foto->update([
                'judul' => $request->judul
            ]);
        }
        return response()->json($foto);
    }

    public function destroy($id)
    {
        $foto = Foto::find($id);
        $foto->delete();
        
        return redirect()->back();
    }
}
