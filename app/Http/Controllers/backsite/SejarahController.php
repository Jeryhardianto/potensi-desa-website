<?php

namespace App\Http\Controllers\backsite;

use App\Models\Sejarah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Sejarah::all();
        return view('pages.backsite.sejarah.index', compact('sejarah'));
    }

    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'sejarah' => 'required'

        ],[
            'sejarah.required' =>  'Sejarah Wajib Diisi'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=> $validator->errors()]);
        }

        $sejarah = Sejarah::find($id);

        $sejarah->update([
            'sejarah' => $request->sejarah
        ]);
        return response()->json($sejarah);
    }
}
