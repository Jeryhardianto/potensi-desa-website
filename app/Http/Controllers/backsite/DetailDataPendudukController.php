<?php

namespace App\Http\Controllers\backsite;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;
use App\Models\DetailDataPenduduk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DetailDataPendudukController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index($nokk)
    {
        $dataPenduduk       = DataPenduduk::where('no_kk', $nokk)->first();
        $detailDataPenduduk = DetailDataPenduduk::where('no_kk', $nokk)->get();
    
        return view('pages.backsite.detaildatapenduduk.index', compact('dataPenduduk','detailDataPenduduk', 'nokk'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'namaLengkap' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'pendidikan' => 'required',
            'perkerjaan' => 'required',
            'golongandarah' => 'required',
            'namaorgtua' => 'required',

            'jk' => 'required|not_in:0',
            'agama' => 'required|not_in:0',
            'statuskawin' => 'required|not_in:0',
            'hdk' => 'required|not_in:0',
            'kewarganegaraan' => 'required|not_in:0'

        ],[
            'nik.required' => 'Nomor Induk Kependudukan Keluarga Wajib Diisi',
            'namaLengkap.required' =>  'Nama Lengkap Wajib Diisi',
            'tempatlahir.required' =>  'Tempat Lahir Wajib Diisi',
            'pendidikan.required' =>  'Pendidikan Wajib Diisi',
            'perkerjaan.required' =>  'Perkerjaan Wajib Diisi',
            'golongandarah.required' =>  'Golongan Darah Wajib Diisi',
            'namaorgtua.required' =>  'Nama Orang Tua Wajib Diisi',


            'jk.not_in' =>  'Jenis Kelamin Wajib Diisi',
            'agama.not_in' =>  'Agama Wajib Diisi',
            'statuskawin.not_in' =>  'Status Perkawinan Wajib Diisi',
            'hdk.not_in' =>  'Status Hubungan Dalam Keluarga Wajib Diisi',
            'kewarganegaraan.not_in' =>  'Kewarganegaraan Wajib Diisi',
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $detailDataPenduduk = DetailDataPenduduk::create([
            'no_kk' => $request->no_kk,
            'nama_lengkap' =>  $request->namaLengkap,
            'nik' =>  $request->nik,
            'jenis_kelamin' => $request->jk,
            'tempat_lahir' =>  $request->tempatlahir,
            'tanggal_lahir' =>  $request->tanggallahir,
            'agama' =>  $request->agama,
            'pendidikan' =>  $request->pendidikan,
            'jenis_perkerjaan' =>  $request->perkerjaan,
            'golongan_darah' =>  $request->golongandarah,
            'status_perkawinan' =>  $request->statuskawin,
            'tanggal_perkawinan' =>  $request->tanggalkawin,
            'status_hdk' =>  $request->hdk,
            'kewarganegaraan' =>  $request->kewarganegaraan,
            'dokumen_imigrasi' =>  $request->doc_imigrasi,
            'nama_orang_tua' =>  $request->namaorgtua,
            
        ]);

        return response()->json($detailDataPenduduk);
    }

    public function update(Request $request, $id)
    {
      

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'namaLengkap' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'pendidikan' => 'required',
            'perkerjaan' => 'required',
            'golongandarah' => 'required',
            'tanggalkawin' => 'required',
            'namaorgtua' => 'required',

            'jk' => 'required|not_in:0',
            'agama' => 'required|not_in:0',
            'statuskawin' => 'required|not_in:0',
            'hdk' => 'required|not_in:0',
            'kewarganegaraan' => 'required|not_in:0'

        ],[
            'nik.required' => 'Nomor Induk Kependudukan Keluarga Wajib Diisi',
            'namaLengkap.required' =>  'Nama Lengkap Wajib Diisi',
            'tempatlahir.required' =>  'Tempat Lahir Wajib Diisi',
            'pendidikan.required' =>  'Pendidikan Wajib Diisi',
            'perkerjaan.required' =>  'Perkerjaan Wajib Diisi',
            'golongandarah.required' =>  'Golongan Darah Wajib Diisi',
            'tanggalkawin.required' =>  'Tanggal Kawin Darah Wajib Diisi',
            'namaorgtua.required' =>  'Nama Orang Tua Wajib Diisi',


            'jk.not_in' =>  'Jenis Kelamin Wajib Diisi',
            'agama.not_in' =>  'Agama Wajib Diisi',
            'statuskawin.not_in' =>  'Status Perkawinan Wajib Diisi',
            'hdk.not_in' =>  'Status Hubungan Dalam Keluarga Wajib Diisi',
            'kewarganegaraan.not_in' =>  'Kewarganegaraan Wajib Diisi',
        ]);


        if ($validator->fails()) {

            return response()->json(['errors'=> $validator->errors()]);

        }

        $detailDataPenduduk = DetailDataPenduduk::find($id);


        $detailDataPenduduk->update([
            'nama_lengkap' =>  $request->namaLengkap,
            'nik' =>  $request->nik,
            'jenis_kelamin' => $request->jk,
            'tempat_lahir' =>  $request->tempatlahir,
            'tanggal_lahir' =>  $request->tanggallahir,
            'agama' =>  $request->agama,
            'pendidikan' =>  $request->pendidikan,
            'jenis_perkerjaan' =>  $request->perkerjaan,
            'golongan_darah' =>  $request->golongandarah,
            'status_perkawinan' =>  $request->statuskawin,
            'tanggal_perkawinan' =>  $request->tanggalkawin,
            'status_hdk' =>  $request->hdk,
            'kewarganegaraan' =>  $request->kewarganegaraan,
            'dokumen_imigrasi' =>  $request->doc_imigrasi,
            'nama_orang_tua' =>  $request->namaorgtua,
            
        ]);

        return response()->json($detailDataPenduduk);
    }

    public function destroy($id)
    {
        $detailDataPenduduk = DetailDataPenduduk::find($id);
        $detailDataPenduduk->delete();
        
        return redirect()->back();
    }
}
