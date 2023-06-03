@extends('layouts.app')
@section('title', 'Data Hasil Sumber Daya')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Hasil Sumber Daya
                        </h1>
              
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Data Hasil Sumber Daya</li>
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
                                    <th>Sumber Daya</th>
                                    <th>Periode Awal</th>
                                    <th>Periode Akhir</th>
                                    <th>Jumlah Hasil</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataHasilSumberDaya as $dsd)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$dsd->sumberdaya->nama_sumber_daya}}</td>
                                        <td>{{$dsd->periode_awal}}</td>
                                        <td>{{$dsd->periode_akhir}}</td>
                                        <td>{{$dsd->jumlah_hasil}} {{ $dsd->satuan_hasil }}</td>
                                        <td>

                                            <a href="#" class="btn btn-primary detail-item"
                                                data-target="#detailModal" data-toggle="modal"
                                                data-id="{{$dsd->id}}"
                                                data-id_sumber_daya="{{$dsd->id_sumber_daya}}"
                                                data-periode_awal="{{$dsd->periode_awal}}"
                                                data-periode_akhir="{{$dsd->periode_akhir}}"
                                                data-masa_panen="{{$dsd->masa_panen}}"
                                                data-satuan_panen="{{$dsd->satuan_panen}}"
                                                data-jumlah_hasil="{{$dsd->jumlah_hasil}}"
                                                data-satuan_hasil="{{$dsd->satuan_hasil}}"
                                                data-jumlah_anggota="{{$dsd->jumlah_anggota}}"
                                                data-luas="{{$dsd->luas}}"
                                                data-satuan_luas="{{$dsd->satuan_luas}}"
                                                >

                                                <i class="fas fa-eye"></i> Detail</a>
                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$dsd->id}}"
                                              data-id_sumber_daya="{{$dsd->id_sumber_daya}}"
                                            data-periode_awal="{{$dsd->periode_awal}}"
                                            data-periode_akhir="{{$dsd->periode_akhir}}"
                                            data-masa_panen="{{$dsd->masa_panen}}"
                                            data-satuan_panen="{{$dsd->satuan_panen}}"
                                            data-jumlah_hasil="{{$dsd->jumlah_hasil}}"
                                            data-satuan_hasil="{{$dsd->satuan_hasil}}"
                                            data-jumlah_anggota="{{$dsd->jumlah_anggota}}"
                                            data-luas="{{$dsd->luas}}"
                                            data-satuan_luas="{{$dsd->satuan_luas}}"
                                           >
                            
                                               <i class="fas fa-pen-square"></i> Edit</a>

                                            <form class="d-inline" method="post" role="alert" action="{{ route('hasilsumberdaya.destroy', $dsd->id) }}">
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
            <form id="add-form" method="post" action="#">
             @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Hasil Sumber Daya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Nama Sumber Daya</label>
                                        <select class="form-control" style="width: 100%;" id="sumber_daya" name="sumber_daya" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Sumber Daya ---</option>
                                            @foreach ($sumberdayas as $sd)
                                                <option value="{{ $sd->id }}">{{ $sd->nama_sumber_daya }}</option>
                                            @endforeach
                                         
                                        </select>
                                        <span id="errorSumberDaya" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="periodeawal">Periode Awal</label>
                                        <input type="date" class="form-control" id="periodeawal" name="periodeawal" >
                                        <span id="errorPeriodeAwal" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="periodeakhir">Periode Akhir</label>
                                        <input type="date" class="form-control" id="periodeakhir" name="periodeakhir" >
                                        <span id="errorPeriodeAkhir" class="error"></span>
                                    </div>


                                    <div class="form-group">
                                        <label for="masapanen">Masa Panen</label>
                                        <input type="text" class="form-control" id="masapanen" name="masapanen" >
                                        <span id="errorMasaPanen" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="satuanpanen">Satuan Panen</label>
                                        <input type="text" class="form-control" id="satuanpanen" name="satuanpanen" >
                                        <span id="errorSatuanPanen" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_hasil">Jumlah Hasil</label>
                                        <input type="text" class="form-control" id="jumlah_hasil" name="jumlah_hasil" >
                                        <span id="errorJumlahHasil" class="error"></span>
                                    </div>

                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="satuan_hasil">Satuan Hasil</label>
                                        <input type="text" class="form-control" id="satuan_hasil" name="satuan_hasil" >
                                        <span id="errorSatuanHasil" class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_anggota">Jumlah Anggota</label>
                                        <input type="text" class="form-control" id="jumlah_anggota" name="jumlah_anggota" >
                                        <span id="errorJumlahAnggota" class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="luas">Luas</label>
                                        <input type="text" class="form-control" id="luas" name="luas" >
                                        <span id="errorLuas" class="error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="satuanluas">Satuan Luas</label>
                                        <input type="text" class="form-control" id="satuanluas" name="satuanluas" >
                                        <span id="errorSatuanLuas" class="error"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Edit Data Hasil Sumber Daya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama Sumber Daya</label>
                                <select class="form-control" style="width: 100%;" id="edit-sumber_daya" name="sumber_daya" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0">-- Pilih Sumber Daya ---</option>
                                    @foreach ($sumberdayas as $sd)
                                        <option value="{{ $sd->id }}">{{ $sd->nama_sumber_daya }}</option>
                                    @endforeach
                                 
                                </select>
                                <span id="edit-errorSumberDaya" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="periodeawal">Periode Awal</label>
                                <input type="date" class="form-control" id="edit-periodeawal" name="periodeawal" >
                                <span id="edit-errorPeriodeAwal" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="periodeakhir">Periode Akhir</label>
                                <input type="date" class="form-control" id="edit-periodeakhir" name="periodeakhir" >
                                <span id="edit-errorPeriodeAkhir" class="error"></span>
                            </div>


                            <div class="form-group">
                                <label for="masapanen">Masa Panen</label>
                                <input type="text" class="form-control" id="edit-masapanen" name="masapanen" >
                                <span id="edit-errorMasaPanen" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="satuanpanen">Satuan Panen</label>
                                <input type="text" class="form-control" id="edit-satuanpanen" name="satuanpanen" >
                                <span id="edit-errorSatuanPanen" class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_hasil">Jumlah Hasil</label>
                                <input type="text" class="form-control" id="edit-jumlah_hasil" name="jumlah_hasil" >
                                <span id="edit-errorJumlahHasil" class="error"></span>
                            </div>

                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="satuan_hasil">Satuan Hasil</label>
                                <input type="text" class="form-control" id="edit-satuan_hasil" name="satuan_hasil" >
                                <span id="edit-errorSatuanHasil" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_anggota">Jumlah Anggota</label>
                                <input type="text" class="form-control" id="edit-jumlah_anggota" name="jumlah_anggota" >
                                <span id="edit-errorJumlahAnggota" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="luas">Luas</label>
                                <input type="text" class="form-control" id="edit-luas" name="luas" >
                                <span id="edit-errorLuas" class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="satuanluas">Satuan Luas</label>
                                <input type="text" class="form-control" id="edit-satuanluas" name="satuanluas" >
                                <span id="edit-errorSatuanLuas" class="error"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Detail Kelompok Tani</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama Sumber Daya</label>
                                <select class="form-control" style="width: 100%;" id="detail-sumber_daya" name="sumber_daya" data-select2-id="1" tabindex="-1" aria-hidden="true" readonly>
                                    <option value="0">-- Pilih Sumber Daya ---</option>
                                    @foreach ($sumberdayas as $sd)
                                        <option value="{{ $sd->id }}">{{ $sd->nama_sumber_daya }}</option>
                                    @endforeach
                                 
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="periodeawal">Periode Awal</label>
                                <input readonly type="date" class="form-control" id="detail-periodeawal" name="periodeawal" >
                                
                            </div>

                            <div class="form-group">
                                <label for="periodeakhir">Periode Akhir</label>
                                <input readonly type="date" class="form-control" id="detail-periodeakhir" name="periodeakhir" >
                                
                            </div>


                            <div class="form-group">
                                <label for="masapanen">Masa Panen</label>
                                <input readonly type="text" class="form-control" id="detail-masapanen" name="masapanen" >
                                
                            </div>

                            <div class="form-group">
                                <label for="satuanpanen">Satuan Panen</label>
                                <input readonly type="text" class="form-control" id="detail-satuanpanen" name="satuanpanen" >
                                
                            </div>

                            <div class="form-group">
                                <label for="jumlah_hasil">Jumlah Hasil</label>
                                <input readonly type="text" class="form-control" id="detail-jumlah_hasil" name="jumlah_hasil" >
                                
                            </div>

                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="satuan_hasil">Satuan Hasil</label>
                                <input readonly type="text" class="form-control" id="detail-satuan_hasil" name="satuan_hasil" >
                               
                            </div>
                            <div class="form-group">
                                <label for="jumlah_anggota">Jumlah Anggota</label>
                                <input readonly type="text" class="form-control" id="detail-jumlah_anggota" name="jumlah_anggota" >
                             
                            </div>
                            <div class="form-group">
                                <label for="luas">Luas</label>
                                <input readonly type="text" class="form-control" id="detail-luas" name="luas" >
                                
                            </div>
                            <div class="form-group">
                                <label for="satuanluas">Satuan Luas</label>
                                <input readonly type="text" class="form-control" id="detail-satuanluas" name="satuanluas" >
                                
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

//  Ajax Insert
  $("#add-form").submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "{{ route('hasilsumberdaya.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorSumberDaya').text(response.errors.sumber_daya ? response.errors.sumber_daya[0]  : '');
                  $('#errorPeriodeAwal').text(response.errors.periodeawal ? response.errors.periodeawal[0]  : '');
                  $('#errorPeriodeAkhir').text(response.errors.periodeakhir ? response.errors.periodeakhir[0]  : '');
                  $('#errorMasaPanen').text(response.errors.masapanen ? response.errors.masapanen[0]  : '');
                  $('#errorSatuanPanen').text(response.errors.satuanpanen ? response.errors.satuanpanen[0]  : '');
                  $('#errorJumlahHasil').text(response.errors.jumlah_hasil ? response.errors.jumlah_hasil[0]  : '');
                  $('#errorSatuanHasil').text(response.errors.satuan_hasil ? response.errors.satuan_hasil[0]  : '');
                  $('#errorJumlahAnggota').text(response.errors.jumlah_anggota ? response.errors.jumlah_anggota[0]  : '');
                  $('#errorLuas').text(response.errors.luas ? response.errors.luas[0]  : '');
                  $('#errorSatuanLuas').text(response.errors.satuanluas ? response.errors.satuanluas[0]  : '');

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
      $('#edit-sumber_daya').val($(this).data('id_sumber_daya'));
      $('#edit-periodeawal').val($(this).data('periode_awal'));
      $('#edit-periodeakhir').val($(this).data('periode_akhir'));
      $('#edit-masapanen').val($(this).data('masa_panen'));
      $('#edit-satuanpanen').val($(this).data('satuan_panen'));
      $('#edit-jumlah_hasil').val($(this).data('jumlah_hasil'));
      $('#edit-satuan_hasil').val($(this).data('satuan_hasil'));
      $('#edit-jumlah_anggota').val($(this).data('jumlah_anggota'));
      $('#edit-luas').val($(this).data('luas'));
      $('#edit-satuanluas').val($(this).data('satuan_luas'));
  });


    //  Detail Ajax
  $('.detail-item').click(function() {
      $('#detail-sumber_daya').val($(this).data('id_sumber_daya'));
      $('#detail-periodeawal').val($(this).data('periode_awal'));
      $('#detail-periodeakhir').val($(this).data('periode_akhir'));
      $('#detail-masapanen').val($(this).data('masa_panen'));
      $('#detail-satuanpanen').val($(this).data('satuan_panen'));
      $('#detail-jumlah_hasil').val($(this).data('jumlah_hasil'));
      $('#detail-satuan_hasil').val($(this).data('satuan_hasil'));
      $('#detail-jumlah_anggota').val($(this).data('jumlah_anggota'));
      $('#detail-luas').val($(this).data('luas'));
      $('#detail-satuanluas').val($(this).data('satuan_luas'));
  });

  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/hasilsumberdaya/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorSumberDaya').text(response.errors.sumber_daya ? response.errors.sumber_daya[0]  : '');
                  $('#edit-errorPeriodeAwal').text(response.errors.periodeawal ? response.errors.periodeawal[0]  : '');
                  $('#edit-errorPeriodeAkhir').text(response.errors.periodeakhir ? response.errors.periodeakhir[0]  : '');
                  $('#edit-errorMasaPanen').text(response.errors.masapanen ? response.errors.masapanen[0]  : '');
                  $('#edit-errorSatuanPanen').text(response.errors.satuanpanen ? response.errors.satuanpanen[0]  : '');
                  $('#edit-errorJumlahHasil').text(response.errors.jumlah_hasil ? response.errors.jumlah_hasil[0]  : '');
                  $('#edit-errorSatuanHasil').text(response.errors.satuan_hasil ? response.errors.satuan_hasil[0]  : '');
                  $('#edit-errorJumlahAnggota').text(response.errors.jumlah_anggota ? response.errors.jumlah_anggota[0]  : '');
                  $('#edit-errorLuas').text(response.errors.luas ? response.errors.luas[0]  : '');
                  $('#edit-errorSatuanLuas').text(response.errors.satuanluas ? response.errors.satuanluas[0]  : '');

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
                    title: 'Hapus Data Hasil Sumber Daya',
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
