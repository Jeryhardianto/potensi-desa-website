@extends('layouts.app')
@section('title', 'Kelompok Tani')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kelompok Tani
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Kelompok Tani</li>
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
                                    <th>Nama Kelompok Tani</th>
                                    <th>Nama Ketua</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelompoktanis as $kt)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$kt->nama_poktan}}</td>
                                        <td>{{$kt->ketua_poktan}}</td>
                                        <td>

                                            <a href="#" class="btn btn-primary detail-item"
                                                data-target="#detailModal" data-toggle="modal"
                                                data-id="{{$kt->id}}"
                                                data-nama_poktan="{{$kt->nama_poktan}}"
                                                data-ketua="{{$kt->ketua_poktan}}"
                                                >

                                                <i class="fas fa-eye"></i> Detail</a>

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$kt->id}}"
                                              data-nama_poktan="{{$kt->nama_poktan}}"
                                              data-ketua="{{$kt->ketua_poktan}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>

                                               <a href="{{route('anggotapoktan.index', $kt->id)}}" class="btn btn-warning">
                                                <i class="fas fa-plus"></i> Tambah Anggota PokTan</a>


                                            <form class="d-inline" method="post" role="alert" action="{{ route('kelompoktani.destroy', $kt->id) }}">
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Kolompok Tani</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_poktan">Nama Kelompok Tani</label>
                                        <input type="text" class="form-control" id="nama_poktan" name="nama_poktan" >
                                        <span id="errorNamaPoktan" class="error"></span>

                                    </div>


                                    <div class="form-group">
                                        <label for="ketua">Nama Ketua</label>
                                        <input type="text" class="form-control" id="ketua" name="ketua" >
                                        <span id="errorKetua" class="error"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Edit Kelompok Tani</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_poktan">Nama Kelompok Tani</label>
                                <input type="text" class="form-control" id="edit-nama_poktan" name="nama_poktan" >
                                <span id="edit-errorNamaPoktan" class="error"></span>

                            </div>


                            <div class="form-group">
                                <label for="ketua">Nama Ketua</label>
                                <input type="text" class="form-control" id="edit-ketua" name="ketua" >
                                <span id="edit-errorKetua" class="error"></span>
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
                                <label for="nama_poktan">Nama Kelompok Tani</label>
                                <input type="text" class="form-control" id="detail-nama_poktan" name="nama_poktan" readonly>

                            </div>


                            <div class="form-group">
                                <label for="ketua">Nama Ketua</label>
                                <input type="text" class="form-control" id="detail-ketua" name="ketua" readonly>
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
          url: "{{ route('kelompoktani.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorNamaPoktan').text(response.errors.nama_poktan ? response.errors.nama_poktan[0]  : '');
                  $('#errorKetua').text(response.errors.ketua ? response.errors.ketua[0]  : '');

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
      $('#edit-nama_poktan').val($(this).data('nama_poktan'));
      $('#edit-ketua').val($(this).data('ketua'));
  });

  //  Detail Ajax
  $('.detail-item').click(function() {
    $('#detail-nama_poktan').val($(this).data('nama_poktan'));
    $('#detail-ketua').val($(this).data('ketua'));
  });

  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/kelompoktani/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorNamaPoktan').text(response.errors.nama_poktan ? response.errors.nama_poktan[0]  : '');
                  $('#edit-errorKetua').text(response.errors.ketua ? response.errors.ketua[0]  : '');

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
                    title: 'Hapus Data Kelompok Tani',
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
