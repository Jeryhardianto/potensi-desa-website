@extends('layouts.app')
@section('title', 'Anggota Kelompok Tani')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Anggota Kelompok Tani
                        </h1>
                        <div class="mt-2">
                            <h5>Nama Kelompok Tani : {{$poktan->nama_poktan}}</h5>
                            <h5>Ketua : {{ $poktan->ketua_poktan }} </h5>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Anggota Kelompok Tani</li>
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
                                    <th>Nama</th>
                                    <th>Kelompok Tani</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggotapoktan as $apt)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$apt->nama}}</td>
                                        <td>{{$poktan->nama_poktan}}</td>
                                        <td>
                                            @if ($apt->is_status == 1)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            @endif
                                        
                                        </td>
                                        <td>

                                          

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$apt->id}}"
                                              data-nama="{{$apt->nama}}"
                                              data-status="{{$apt->is_status}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>

                                               

                                            <form class="d-inline" method="post" role="alert" action="{{ route('anggotapoktan.destroy', $apt->id) }}">
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Anggota Kolompok Tani {{ $poktan->nama_poktan }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Anggota</label>
                                        <input type="text" class="form-control" id="nama" name="nama" >
                                        <span id="errorNama" class="error"></span>

                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" style="width: 100%;" id="status" name="status" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option value="2">-- Pilih Status ---</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                        </select>
                                        <span id="errorStatus" class="error"></span>
                                    </div>
                                </div>     
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" id="id_poktan" name="id_poktan" value="{{ $poktan->id }}" hidden>
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
                    <h5 class="modal-title" id="addModalLabel">Edit Anggota Kelompok Tani</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit-nama">Nama Anggota</label>
                                <input type="text" class="form-control" id="edit-nama" name="nama" >
                                <span id="edit-errorNama" class="error"></span>

                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" style="width: 100%;" id="edit-status" name="status" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="2">-- Pilih Status ---</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <span id="edit-errorStatus" class="error"></span>
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
          url: "{{ route('anggotapoktan.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorNama').text(response.errors.nama ? response.errors.nama[0]  : '');
                  $('#errorStatus').text(response.errors.status ? response.errors.status[0]  : '');

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
      $('#edit-nama').val($(this).data('nama'));
      $('#edit-status').val($(this).data('status'));
  });



  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/anggotapoktan/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                $('#edit-errorNama').text(response.errors.nama ? response.errors.nama[0]  : '');
                  $('#edit-errorStatus').text(response.errors.status ? response.errors.status[0]  : '');

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
                    title: 'Hapus Data Anggota Kelompok Tani',
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
