@extends('layouts.app')
@section('title', 'Detail Data Penduduk')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Data Penduduk
                        </h1>
                        <div class="mt-2">
                            <h5>Nomor Kartu Keluarga : {{$nokk}}</h5>
                            <h5>Kepala Keluarga : {{ $dataPenduduk->kepala_keluarga }} </h5>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Detail Data Penduduk</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div> --}}
                    <!-- /.card-header -->

                    <div class="card-body">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>


                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailDataPenduduk as $dp)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$dp->nik}}</td>
                                        <td>{{$dp->nama_lengkap}}</td>
                                        <td>{{$dp->jenis_kelamin}}</td>
                                        <td>

                                            <a href="#" class="btn btn-primary detail-item"
                                                data-target="#detailModal" data-toggle="modal"
                                                data-id="{{$dp->id}}"
                                                data-no_kk="{{$dp->no_kk}}"
                                                data-nama_lengkap="{{$dp->nama_lengkap}}"
                                                data-nik="{{$dp->nik}}"
                                                data-jenis_kelamin="{{$dp->jenis_kelamin}}"
                                                data-tempat_lahir="{{$dp->tempat_lahir}}"
                                                data-tanggal_lahir="{{$dp->tanggal_lahir}}"
                                                data-agama="{{$dp->agama}}"
                                                data-pendidikan="{{$dp->pendidikan}}"
                                                data-jenis_perkerjaan="{{$dp->jenis_perkerjaan}}"
                                                data-status_perkawinan="{{$dp->status_perkawinan}}"  
                                                data-tanggal_perkawinan="{{$dp->tanggal_perkawinan}}" 
                                                data-status_hdk="{{$dp->status_hdk}}"  
                                                data-kewarganegaraan="{{$dp->kewarganegaraan}}"  
                                                data-golongandarah="{{$dp->golongan_darah}}"  
                                                data-dokumen_imigrasi="{{$dp->dokumen_imigrasi}}"  
                                                data-nama_orang_tua="{{$dp->nama_orang_tua}}"
                                                >

                                                <i class="fas fa-eye"></i> Detail</a>

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$dp->id}}"
                                              data-no_kk="{{$dp->no_kk}}"
                                              data-nama_lengkap="{{$dp->nama_lengkap}}"
                                              data-nik="{{$dp->nik}}"
                                              data-jenis_kelamin="{{$dp->jenis_kelamin}}"
                                              data-tempat_lahir="{{$dp->tempat_lahir}}"
                                              data-tanggal_lahir="{{$dp->tanggal_lahir}}"
                                              data-agama="{{$dp->agama}}"
                                              data-pendidikan="{{$dp->pendidikan}}"
                                              data-jenis_perkerjaan="{{$dp->jenis_perkerjaan}}"
                                              data-status_perkawinan="{{$dp->status_perkawinan}}"  
                                              data-tanggal_perkawinan="{{$dp->tanggal_perkawinan}}" 
                                              data-status_hdk="{{$dp->status_hdk}}"  
                                              data-kewarganegaraan="{{$dp->kewarganegaraan}}"  
                                              data-golongandarah="{{$dp->golongan_darah}}"  
                                              data-dokumen_imigrasi="{{$dp->dokumen_imigrasi}}"  
                                              data-nama_orang_tua="{{$dp->nama_orang_tua}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>


                                            <form class="d-inline" method="post" role="alert" action="{{ route('detaildatapenduduk.destroy', $dp->id) }}">
                                                @csrf
                                                @method('delete')
                                                  <button type="submit" class="btn btn-danger">
                                                      <i class="fas fa-trash"></i> Hapus</a>
                                                  </button>
                                              </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- END: Content-->
{{-- Add  Modal--}}
    <div class="row">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 68%;">
            <form id="add-form" method="post" action="{{route('detaildatapenduduk.store')}}">
             @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Detail Data Penduduk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_kk">Nomor Kartu Keluarga</label>
                                        <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ $nokk }}" readonly>
                                        <span id="errorNoKK" class="error"></span>

                                    </div>

                            
                                    <div class="form-group">
                                        <label for="nik">Nomor Induk Kependudukan</label>
                                        <input type="text" class="form-control" id="nik" name="nik" >
                                        <span id="errorNIK" class="error"></span>
                                    </div>  

                                    <div class="form-group">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" >
                                        <span id="errorNamaLengkap" class="error"></span>
                                    </div>
                            
                                    <div class="form-group">
                                        <label for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" >
                                        <span id="errorTanggalLahir" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" style="width: 100%;" id="jk" name="jk" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Jenis Kelamin ---</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                        <span id="errorJK" class="error"></span>
                                    </div>


                                    <div class="form-group">
                                        <label for="tempatlahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" >
                                        <span id="errorTempatLahir" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select class="form-control" style="width: 100%;" id="agama" name="agama" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Agama ---</option>
                                            <option value="1">Islam</option>
                                            <option value="2">Katolik</option>
                                            <option value="3">Protestan</option>
                                            <option value="4">Hindu</option>
                                            <option value="5">Budha</option>
                                            <option value="6">Konghucu</option>
                                        </select>
                                        <span id="errorAgama" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <input type="text" class="form-control" id="pendidikan" name="pendidikan" >
                                        <span id="errorPendidikan" class="error"></span>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="perkerjaan">Jenis Perkerjaan</label>
                                        <input type="text" class="form-control" id="perkerjaan" name="perkerjaan">
                                        <span id="errorPerkerjaan" class="error"></span>

                                    </div>

                            
                                    <div class="form-group">
                                        <label for="golongandarah">Golongan Darah</label>
                                        <input type="text" class="form-control" id="golongandarah" name="golongandarah" >
                                        <span id="errorGolonganDarah" class="error"></span>
                                    </div>  
                                    <div class="form-group">
                                        <label>Status Perkawinan</label>
                                        <select class="form-control" style="width: 100%;" id="statuskawin" name="statuskawin" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Status Perkawinan ---</option>
                                            <option value="1">Belum Kawin</option>
                                            <option value="2">Kawin</option>
                                        </select>
                                        <span id="errorStatuskawin" class="error"></span>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="tanggalkawin">Tanggal Perkawinan</label>
                                        <input type="date" class="form-control" id="tanggalkawin" name="tanggalkawin" >
                                        <span id="errorTanggalKawin" class="error"></span>
                                    </div>


                                    <div class="form-group">
                                        <label>Status Hubungan Dalam Keluarga</label>
                                        <select class="form-control" style="width: 100%;" id="hdk" name="hdk" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Status Hubungan Dalam Keluarga ---</option>
                                            <option value="1">Kepala Keluarga</option>
                                            <option value="2">Istri</option>
                                            <option value="3">Anak</option>
                                        </select>
                                        <span id="errorHDK" class="error"></span>
                                    </div>



                                    <div class="form-group">
                                        <label>Kewarganegaraan</label>
                                        <select class="form-control" style="width: 100%;" id="kewarganegaraan" name="kewarganegaraan" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Kewarganegaraan ---</option>
                                            <option value="1">WNI</option>
                                            <option value="2">WNA</option>
                                        </select>
                                        <span id="errorKewarganegaraan" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="doc_imigrasi">Dokumen Imigrasi</label>
                                        <input type="text" class="form-control" id="doc_imigrasi" name="doc_imigrasi" >
                                        <span id="errorDoc_Imigrasi" class="error"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="namaorgtua">Nama Orang Tua</label>
                                        <input type="text" class="form-control" id="namaorgtua" name="namaorgtua" >
                                        <span id="errorNamaorgtua" class="error"></span>
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="add-btn">Simpan</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>


{{-- Edit  Modal--}}
<div class="row">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 68%;">
         <form id="edit-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Detail Data Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <div class="modal-body">

                        <div class="row mr-3 ml-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">Nomor Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ $nokk }}" readonly>
                                    <span id="edit-errorNoKK" class="error"></span>

                                </div>

                        
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan</label>
                                    <input type="text" class="form-control" id="edit-nik" name="nik" >
                                    <span id="edit-errorNIK" class="error"></span>
                                </div>  

                                <div class="form-group">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="edit-namaLengkap" name="namaLengkap" >
                                    <span id="edit-errorNamaLengkap" class="error"></span>
                                </div>
                        
                                <div class="form-group">
                                    <label for="tanggallahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit-tanggallahir" name="tanggallahir" >
                                    <span id="edit-errorTanggalLahir" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" style="width: 100%;" id="edit-jk" name="jk" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Jenis Kelamin ---</option>
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                    <span id="edit-errorJK" class="error"></span>
                                </div>


                                <div class="form-group">
                                    <label for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit-tempatlahir" name="tempatlahir" >
                                    <span id="edit-errorTempatLahir" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" style="width: 100%;" id="edit-agama" name="agama" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Agama ---</option>
                                        <option value="1">Islam</option>
                                        <option value="2">Katolik</option>
                                        <option value="3">Protestan</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Budha</option>
                                        <option value="6">Konghucu</option>
                                    </select>
                                    <span id="edit-errorAgama" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan</label>
                                    <input type="text" class="form-control" id="edit-pendidikan" name="pendidikan" >
                                    <span id="edit-errorPendidikan" class="error"></span>
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perkerjaan">Jenis Perkerjaan</label>
                                    <input type="text" class="form-control" id="edit-perkerjaan" name="perkerjaan">
                                    <span id="edit-errorPerkerjaan" class="error"></span>

                                </div>

                        
                                <div class="form-group">
                                    <label for="golongandarah">Golongan Darah</label>
                                    <input type="text" class="form-control" id="edit-golongandarah" name="golongandarah" >
                                    <span id="edit-errorGolonganDarah" class="error"></span>
                                </div>  
                                <div class="form-group">
                                    <label>Status Perkawinan</label>
                                    <select class="form-control" style="width: 100%;" id="edit-statuskawin" name="statuskawin" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Status Perkawinan ---</option>
                                        <option value="1">Belum Kawin</option>
                                        <option value="2">Kawin</option>
                                    </select>
                                    <span id="edit-errorStatuskawin" class="error"></span>
                                </div>

                                
                                <div class="form-group">
                                    <label for="tanggalkawin">Tanggal Perkawinan</label>
                                    <input type="date" class="form-control" id="edit-tanggalkawin" name="tanggalkawin" >
                                    <span id="edit-errorTanggalKawin" class="error"></span>
                                </div>


                                <div class="form-group">
                                    <label>Status Hubungan Dalam Keluarga</label>
                                    <select class="form-control" style="width: 100%;" id="edit-hdk" name="hdk" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Status Hubungan Dalam Keluarga ---</option>
                                        <option value="1">Kepala Keluarga</option>
                                        <option value="2">Istri</option>
                                        <option value="3">Anak</option>
                                        
                                    </select>
                                    <span id="edit-errorHDK" class="error"></span>
                                </div>



                                <div class="form-group">
                                    <label>Kewarganegaraan</label>
                                    <select class="form-control" style="width: 100%;" id="edit-kewarganegaraan" name="kewarganegaraan" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Kewarganegaraan ---</option>
                                        <option value="1">WNI</option>
                                        <option value="2">WNA</option>
                                    </select>
                                    <span id="edit-errorKewarganegaraan" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="doc_imigrasi">Dokumen Imigrasi</label>
                                    <input type="text" class="form-control" id="edit-doc_imigrasi" name="doc_imigrasi" >
                                    <span id="edit-errorDoc_Imigrasi" class="error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="namaorgtua">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="edit-namaorgtua" name="namaorgtua" >
                                    <span id="edit-errorNamaorgtua" class="error"></span>
                                </div>
                            </div>
                        </div>


                </div>


                </div>
                <div class="modal-footer">
                    <input type="text" id="edit-id" name="id" hidden>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="edit-btn">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Detail  Modal--}}
<div class="row">
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 68%;">
         <form id="edit-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Detail Data Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_kk">Nomor Kartu Keluarga</label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ $nokk }}" readonly>

                            </div>

                    
                            <div class="form-group">
                                <label for="nik">Nomor Induk Kependudukan</label>
                                <input type="text" class="form-control" id="detail-nik" name="nik"readonly >
                            </div>  

                            <div class="form-group">
                                <label for="namaLengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="detail-namaLengkap" name="namaLengkap" readonly>
                            </div>
                    
                            <div class="form-group">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="detail-tanggallahir" name="tanggallahir" readonly>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" style="width: 100%;" id="detail-jk" name="jk" data-select2-id="1" tabindex="-1" aria-hidden="true" readonly>
                                    <option value="0">-- Pilih Jenis Kelamin ---</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="tempatlahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="detail-tempatlahir" name="tempatlahir" readonly>
                            </div>

                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control" style="width: 100%;" id="detail-agama" name="agama" data-select2-id="1" tabindex="-1" aria-hidden="true" readonly>
                                    <option value="0">-- Pilih Agama ---</option>
                                    <option value="1">Islam</option>
                                    <option value="2">Katolik</option>
                                    <option value="3">Protestan</option>
                                    <option value="4">Hindu</option>
                                    <option value="5">Budha</option>
                                    <option value="6">Konghucu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="detail-pendidikan" name="pendidikan" readonly>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perkerjaan">Jenis Perkerjaan</label>
                                <input type="text" class="form-control" id="detail-perkerjaan" name="perkerjaan" readonly>

                            </div>

                    
                            <div class="form-group">
                                <label for="golongandarah">Golongan Darah</label>
                                <input type="text" class="form-control" id="detail-golongandarah" name="golongandarah" readonly>
                            </div>  
                            <div class="form-group">
                                <label>Status Perkawinan</label>
                                <select class="form-control" style="width: 100%;" id="detail-statuskawin" name="statuskawin" data-select2-id="1" tabindex="-1" aria-hidden="true" readonly>
                                    <option value="0">-- Pilih Status Perkawinan ---</option>
                                    <option value="1">Belum Kawin</option>
                                    <option value="2">Kawin</option>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="tanggalkawin">Tanggal Perkawinan</label>
                                <input type="date" class="form-control" id="detail-tanggalkawin" name="tanggalkawin" readonly >
                            </div>


                            <div class="form-group">
                                <label>Status Hubungan Dalam Keluarga</label>
                                <select class="form-control" style="width: 100%;" id="detail-hdk" name="hdk" data-select2-id="1" tabindex="-1" aria-hidden="true" readonly>
                                    <option value="0">-- Pilih Jenis Kelamin ---</option>
                                    <option value="1">Kepala Keluarga</option>
                                    <option value="2">Istri</option>
                                    <option value="3">Anak</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label>Kewarganegaraan</label>
                                <select class="form-control" style="width: 100%;" id="detail-kewarganegaraan" name="kewarganegaraan" data-select2-id="1" tabindex="-1" aria-hidden="true"readonly>
                                    <option value="0">-- Pilih Kewarganegaraan ---</option>
                                    <option value="1">WNI</option>
                                    <option value="2">WNA</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="doc_imigrasi">Dokumen Imigrasi</label>
                                <input type="text" class="form-control" id="detail-doc_imigrasi" name="doc_imigrasi" readonly >
                            </div>
                            
                            <div class="form-group">
                                <label for="namaorgtua">Nama Orang Tua</label>
                                <input type="text" class="form-control" id="detail-namaorgtua" name="namaorgtua" readonly>
                            </div>
                        </div>
                    </div>


            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- Datatabel --}}
@push('javascript-internal')
<script>
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


  })

  $('#kode_rt').select2({
      minimumResultsForSearch: -1
  });

  $('#no_kk').mask('9999999999999999');
  $('#nik').mask('9999999999999999');
  $('#edit-nik').mask('9999999999999999');


//  Ajax Insert
  $("#add-form").submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "{{ route('detaildatapenduduk.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorNoKK').text(response.errors.no_kk ? response.errors.no_kk[0]  : '');
                  $('#errorNIK').text(response.errors.nik ? response.errors.nik[0]  : '');
                  $('#errorNamaLengkap').text(response.errors.namaLengkap ? response.errors.namaLengkap[0]  : '');
                  $('#errorTanggalLahir').text(response.errors.tanggallahir ? response.errors.tanggallahir[0]  : '');
                  $('#errorJK').text(response.errors.jk ? response.errors.jk[0]  : '');
                  $('#errorTempatLahir').text(response.errors.tempatlahir ? response.errors.tempatlahir[0]  : '');
                  $('#errorAgama').text(response.errors.agama ? response.errors.agama[0]  : '');
                  $('#errorPendidikan').text(response.errors.pendidikan ? response.errors.pendidikan[0]  : '');
                  $('#errorPerkerjaan').text(response.errors.perkerjaan ? response.errors.perkerjaan[0]  : '');
                  $('#errorGolonganDarah').text(response.errors.golongandarah ? response.errors.golongandarah[0]  : '');
                  $('#errorStatuskawin').text(response.errors.statuskawin ? response.errors.statuskawin[0]  : '');
                  $('#errorTanggalKawin').text(response.errors.tanggalkawin ? response.errors.tanggalkawin[0]  : '');
                  $('#errorHDK').text(response.errors.hdk ? response.errors.hdk[0]  : '');
                  $('#errorKewarganegaraan').text(response.errors.kewarganegaraan ? response.errors.kewarganegaraan[0]  : '');
                //   $('#errorDoc_Imigrasi').text(response.errors.doc_imigrasi ? response.errors.doc_imigrasi[0]  : '');
                  $('#errorNamaorgtua').text(response.errors.namaorgtua ? response.errors.namaorgtua[0]  : '');

              }else{

                  Swal.fire(
                      'Sukses',
                      'Data Berhasil Ditambahkan',
                      'success'
                  )
                  setInterval(function() {
                      location.reload();
                  }, 1000);
              }



          }
      });
  });

//  Edit Ajax
  $('.edit-item').click(function() {
      $('#edit-id').val($(this).data('id'));
      $('#edit-nik').val($(this).data('nik'));
      $('#edit-namaLengkap').val($(this).data('nama_lengkap'));
      $('#edit-tanggallahir').val($(this).data('tanggal_lahir'));
      $('#edit-jk').val($(this).data('jenis_kelamin'));
      $('#edit-tempatlahir').val($(this).data('tempat_lahir'));
      $('#edit-agama').val($(this).data('agama'));
      $('#edit-pendidikan').val($(this).data('pendidikan'));
      $('#edit-perkerjaan').val($(this).data('jenis_perkerjaan'));
      $('#edit-golongandarah').val($(this).data('golongandarah'));
      $('#edit-statuskawin').val($(this).data('status_perkawinan'));
      $('#edit-tanggalkawin').val($(this).data('tanggal_perkawinan'));
      $('#edit-hdk').val($(this).data('status_hdk'));
      $('#edit-kewarganegaraan').val($(this).data('kewarganegaraan'));
      $('#edit-doc_imigrasi').val($(this).data('dokumen_imigrasi'));
      $('#edit-namaorgtua').val($(this).data('nama_orang_tua'));
  });

  //  Detail Ajax
  $('.detail-item').click(function() {
      $('#detail-nik').val($(this).data('nik'));
      $('#detail-namaLengkap').val($(this).data('nama_lengkap'));
      $('#detail-tanggallahir').val($(this).data('tanggal_lahir'));
      $('#detail-jk').val($(this).data('jenis_kelamin'));
      $('#detail-tempatlahir').val($(this).data('tempat_lahir'));
      $('#detail-agama').val($(this).data('agama'));
      $('#detail-pendidikan').val($(this).data('pendidikan'));
      $('#detail-perkerjaan').val($(this).data('jenis_perkerjaan'));
      $('#detail-golongandarah').val($(this).data('golongandarah'));
      $('#detail-statuskawin').val($(this).data('status_perkawinan'));
      $('#detail-tanggalkawin').val($(this).data('tanggal_perkawinan'));
      $('#detail-hdk').val($(this).data('status_hdk'));
      $('#detail-kewarganegaraan').val($(this).data('kewarganegaraan'));
      $('#detail-doc_imigrasi').val($(this).data('dokumen_imigrasi'));
      $('#detail-namaorgtua').val($(this).data('nama_orang_tua'));
  });

  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/detaildatapenduduk/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorNoKK').text(response.errors.no_kk ? response.errors.no_kk[0]  : '');
                  $('#edit-errorNIK').text(response.errors.nik ? response.errors.nik[0]  : '');
                  $('#edit-errorNamaLengkap').text(response.errors.namaLengkap ? response.errors.namaLengkap[0]  : '');
                  $('#edit-errorTanggalLahir').text(response.errors.tanggallahir ? response.errors.tanggallahir[0]  : '');
                  $('#edit-errorJK').text(response.errors.jk ? response.errors.jk[0]  : '');
                  $('#edit-errorTempatLahir').text(response.errors.tempatlahir ? response.errors.tempatlahir[0]  : '');
                  $('#edit-errorAgama').text(response.errors.agama ? response.errors.agama[0]  : '');
                  $('#edit-errorPendidikan').text(response.errors.pendidikan ? response.errors.pendidikan[0]  : '');
                  $('#edit-errorPerkerjaan').text(response.errors.perkerjaan ? response.errors.perkerjaan[0]  : '');
                  $('#edit-errorGolonganDarah').text(response.errors.golongandarah ? response.errors.golongandarah[0]  : '');
                  $('#edit-errorStatuskawin').text(response.errors.statuskawin ? response.errors.statuskawin[0]  : '');
                  $('#edit-errorTanggalKawin').text(response.errors.tanggalkawin ? response.errors.tanggalkawin[0]  : '');
                  $('#edit-errorHDK').text(response.errors.hdk ? response.errors.hdk[0]  : '');
                  $('#edit-errorKewarganegaraan').text(response.errors.kewarganegaraan ? response.errors.kewarganegaraan[0]  : '');
                //   $('#edit-errorDoc_Imigrasi').text(response.errors.doc_imigrasi ? response.errors.doc_imigrasi[0]  : '');
                  $('#edit-errorNamaorgtua').text(response.errors.namaorgtua ? response.errors.namaorgtua[0]  : '');

              }else{

                  Swal.fire(
                      'Sukses',
                      'Data Berhasil Diubah',
                      'success'
                  )
                  setInterval(function() {
                      location.reload();
                  }, 1000);
              }
          }

      });
  });

</script>
@endpush

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                // alert('Hallo');
                Swal.fire({
                    title: 'Hapus Data Penduduk',
                    text: "Apakah anda yakin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {

                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                })
            });
        });
    </script>
@endpush
