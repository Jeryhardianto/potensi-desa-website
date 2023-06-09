@extends('layouts.app')
@section('title', 'Data Penduduk')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Penduduk
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Data Penduduk</li>
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

                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Kepala Keluarga</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataPenduduks as $dp)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$dp->no_kk}}</td>
                                        <td>{{$dp->kepala_keluarga}}</td>
                                        <td>

                                            <a href="#" class="btn btn-primary detail-item"
                                                data-target="#detailModal" data-toggle="modal"
                                                data-id="{{$dp->id}}"
                                                data-no_kk="{{$dp->no_kk}}"
                                                data-kode_rt="{{$dp->kode_rt}}"
                                                data-kk="{{$dp->kepala_keluarga}}"
                                                data-alamat="{{$dp->alamat}}"
                                                >

                                                <i class="fas fa-eye"></i> Detail</a>

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$dp->id}}"
                                              data-no_kk="{{$dp->no_kk}}"
                                              data-kode_rt="{{$dp->kode_rt}}"
                                              data-kk="{{$dp->kepala_keluarga}}"
                                              data-alamat="{{$dp->alamat}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>

                                               <a href="{{route('detaildatapenduduk.index', $dp->no_kk)}}" class="btn btn-warning">
                                                <i class="fas fa-plus"></i> Tambah Anggota Keluarga</a>

                                            <form class="d-inline" method="post" role="alert" action="{{ route('datapenduduk.destroy', $dp->id) }}">
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
            <form id="add-form" method="post" action="{{route('datapenduduk.store')}}">
             @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="addModalLabel">Tambah Data Penduduk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_kk">Nomor Kartu Keluarga</label>
                                        <input type="text" class="form-control" id="no_kk" name="no_kk" >
                                        <span id="errorNoKK" class="error"></span>

                                    </div>

                                    <div class="form-group">
                                        <label>Kode RT</label>
                                        <select class="form-control" style="width: 100%;" id="kode_rt" name="kode_rt" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0">-- Pilih Kode RT ---</option>
                                            @foreach ($rts as $rt)
                                                <option value="{{ $rt->id }}">{{ $rt->nama_rt }}</option>
                                            @endforeach
                                        </select>
                                        <span id="errorKodeRT" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_kk">Kepala Keluarga</label>
                                        <input type="text" class="form-control" id="kk" name="kk" >
                                        <span id="errorKK" class="error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" ></textarea>
                                        <span id="errorAlamat" class="error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prov">Provinsi</label>
                                        <input type="text" class="form-control" id="prov" name="prov" value="Kalimantan Utara" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="kab">Kabupaten</label>
                                        <input type="text" class="form-control" id="kab" name="kab" value="Kabupaten Malinau" readonly>

                                    </div>

                                    <div class="form-group">
                                        <label for="kec">Kecematan</label>
                                        <input type="text" class="form-control" id="kec" name="kec" value="Malinau Utara" readonly>

                                    </div>


                                    <div class="form-group">
                                        <label for="no_kk">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodepos" name="kodepos" value="77557" readonly>
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
                    <h5 class="modal-title" id="addModalLabel">Edit Data Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                        @csrf
                        <div class="row mr-3 ml-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">Nomor Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="edit-nokk" name="no_kk">
                                    <span id="edit-errorNoKK" class="error"></span>

                                </div>

                                <div class="form-group">
                                    <label>Kode RT</label>
                                    <select class="form-control" style="width: 100%;" id="edit-kodert" name="kode_rt" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="0">-- Pilih Kode RT ---</option>
                                        @foreach ($rts as $rt)
                                            <option value="{{ $rt->id }}">{{ $rt->nama_rt }}</option>
                                        @endforeach
                                    </select>
                                    <span id="edit-errorKodeRT" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="no_kk">Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="edit-kk" name="kk">
                                    <span id="edit-errorKK" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="edit-alamat" name="alamat" rows="3" ></textarea>
                                    <span id="edit-errorAlamat" class="error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prov">Provinsi</label>
                                    <input type="text" class="form-control" id="prov" name="prov" value="Kalimantan Utara" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kab">Kabupaten</label>
                                    <input type="text" class="form-control" id="kab" name="kab" value="Kabupaten Malinau" readonly>

                                </div>

                                <div class="form-group">
                                    <label for="kec">Kecematan</label>
                                    <input type="text" class="form-control" id="kec" name="kec" value="Malinau Utara" readonly>

                                </div>


                                <div class="form-group">
                                    <label for="no_kk">Kode Pos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" value="77557" readonly>
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


                        @csrf
                        <div class="row mr-3 ml-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">Nomor Kartu Keluarga</label>
                                    <input type="text" class="form-control" id="detail-nokk" name="no_kk" readonly>

                                </div>

                                <div class="form-group">
                                    <label>Kode RT</label>
                                    <input type="text" class="form-control" id="detail-kodert" name="kodert" readonly>

                                </div>

                                <div class="form-group">
                                    <label for="no_kk">Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="detail-kk" name="kk" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="detail-alamat" name="alamat" rows="3" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prov">Provinsi</label>
                                    <input type="text" class="form-control" id="prov" name="prov" value="Kalimantan Utara" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="kab">Kabupaten</label>
                                    <input type="text" class="form-control" id="kab" name="kab" value="Kabupaten Malinau" readonly>

                                </div>

                                <div class="form-group">
                                    <label for="kec">Kecematan</label>
                                    <input type="text" class="form-control" id="kec" name="kec" value="Malinau Utara" readonly>

                                </div>


                                <div class="form-group">
                                    <label for="no_kk">Kode Pos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" value="77557" readonly>
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
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf"]
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


//  Ajax Insert
  $("#add-form").submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: "{{ route('datapenduduk.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorNoKK').text(response.errors.no_kk ? response.errors.no_kk[0]  : '');
                  $('#errorKodeRT').text(response.errors.kode_rt ? response.errors.kode_rt[0]  : '');
                  $('#errorKK').text(response.errors.kk ? response.errors.kk[0]  : '');
                  $('#errorAlamat').text(response.errors.alamat ? response.errors.alamat[0]  : '');

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
      $('#edit-nokk').val($(this).data('no_kk'));
      $('#edit-kodert').val($(this).data('kode_rt'));
      $('#edit-kk').val($(this).data('kk'));
      $('#edit-alamat').val($(this).data('alamat'));
  });

  //  Detail Ajax
  $('.detail-item').click(function() {
      $('#detail-id').val($(this).data('id'));
      $('#detail-nokk').val($(this).data('no_kk'));
      $('#detail-kodert').val($(this).data('kode_rt'));
      $('#detail-kk').val($(this).data('kk'));
      $('#detail-alamat').val($(this).data('alamat'));
  });

  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/datapenduduk/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorNoKK').text(response.errors.no_kk ? response.errors.no_kk[0]  : '');
                  $('#edit-errorKodeRT').text(response.errors.kode_rt ? response.errors.kode_rt[0]  : '');
                  $('#edit-errorKK').text(response.errors.kk ? response.errors.kk[0]  : '');
                  $('#edit-errorAlamat').text(response.errors.alamat ? response.errors.alamat[0]  : '');

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
