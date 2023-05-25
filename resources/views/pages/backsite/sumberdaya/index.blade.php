@extends('layouts.app')
@section('title', 'Sumber Daya')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sumber Daya
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Sumber Daya</li>
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
                                    <th>Kode Sumber Daya</th>
                                    <th>Nama Sumber Daya</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sumberdayas as $sd)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$sd->kode_sumber_daya}}</td>
                                        <td>{{$sd->nama_sumber_daya}}</td>
                                        <td>

                                            <a href="#" class="btn btn-primary detail-item"
                                                data-target="#detailModal" data-toggle="modal"
                                                data-id="{{$sd->id}}"
                                                data-kodesumberdaya="{{$sd->kode_sumber_daya}}"
                                                data-namasumberdaya="{{$sd->nama_sumber_daya}}"
                                                data-keterangan="{{$sd->keterangan}}"
                                                >

                                                <i class="fas fa-eye"></i> Detail</a>

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$sd->id}}"
                                              data-kodesumberdaya="{{$sd->kode_sumber_daya}}"
                                              data-namasumberdaya="{{$sd->nama_sumber_daya}}"
                                              data-keterangan="{{$sd->keterangan}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>

                                               <a href="{{route('detailsumberdaya.index', $sd->id)}}" class="btn btn-warning">
                                                <i class="fas fa-plus"></i> Tambah Detail Sumber Daya</a>


                                            <form class="d-inline" method="post" role="alert" action="{{ route('sumberdaya.destroy', $sd->id) }}">
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Sumber Daya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_sumber_daya">Kode Sumber Daya</label>
                                        <input type="text" class="form-control" id="kode_sumber_daya" name="kode_sumber_daya" >
                                        <span id="errorKodeSumberDaya" class="error"></span>

                                    </div>


                                    <div class="form-group">
                                        <label for="namasuberdaya">Nama Sumber Daya</label>
                                        <input type="text" class="form-control" id="namasuberdaya" name="namasuberdaya" >
                                        <span id="errorNamaSumberDaya" class="error"></span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5"></textarea>
                                        <span id="errorKeterangan" class="error"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Edit Sumber Daya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_sumber_daya">Kode Sumber Daya</label>
                                <input type="text" class="form-control" id="edit-kode_sumber_daya" name="kode_sumber_daya" >
                                <span id="edit-errorKodeSumberDaya" class="error"></span>

                            </div>


                            <div class="form-group">
                                <label for="namasuberdaya">Nama Sumber Daya</label>
                                <input type="text" class="form-control" id="edit-namasuberdaya" name="namasuberdaya" >
                                <span id="edit-errorNamaSumberDaya" class="error"></span>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="edit-keterangan" cols="10" rows="5"></textarea>
                                <span id="edit-errorKeterangan" class="error"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Detail Sumber Daya</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_sumber_daya">Kode Sumber Daya</label>
                                <input type="text" class="form-control" id="detail-kode_sumber_daya" name="kode_sumber_daya" readonly>

                            </div>


                            <div class="form-group">
                                <label for="namasuberdaya">Nama Sumber Daya</label>
                                <input type="text" class="form-control" id="detail-namasuberdaya" name="namasuberdaya" readonly>
         
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="detail-keterangan" cols="10" rows="5" readonly></textarea>

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
          url: "{{ route('sumberdaya.store') }}",
          data: $('#add-form').serialize(),

          success: function (response) {

              if(response.errors)
              {
                  $('#errorKodeSumberDaya').text(response.errors.kode_sumber_daya ? response.errors.kode_sumber_daya[0]  : '');
                  $('#errorNamaSumberDaya').text(response.errors.namasuberdaya ? response.errors.namasuberdaya[0]  : '');
                  $('#errorKeterangan').text(response.errors.keterangan ? response.errors.keterangan[0]  : '');
                

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
        $('#edit-kode_sumber_daya').val($(this).data('kodesumberdaya'));
        $('#edit-namasuberdaya').val($(this).data('namasumberdaya'));
        $('#edit-keterangan').val($(this).data('keterangan'));
  });

  //  Detail Ajax
  $('.detail-item').click(function() {
        $('#detail-kode_sumber_daya').val($(this).data('kodesumberdaya'));
        $('#detail-namasuberdaya').val($(this).data('namasumberdaya'));
        $('#detail-keterangan').val($(this).data('keterangan'));
    });
  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/sumberdaya/'+ id,
          data: formData,
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorKodeSumberDaya').text(response.errors.kode_sumber_daya ? response.errors.kode_sumber_daya[0]  : '');
                  $('#edit-errorNamaSumberDaya').text(response.errors.namasuberdaya ? response.errors.namasuberdaya[0]  : '');
                  $('#edit-errorKeterangan').text(response.errors.keterangan ? response.errors.keterangan[0]  : '');

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
                    title: 'Hapus Data Sumber Daya Tani',
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
