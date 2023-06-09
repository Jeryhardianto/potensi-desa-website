@extends('layouts.app')
@section('title', 'Foto')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Foto
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Foto</li>
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
                                    <th>Judul</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fotos as $ft)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$ft->judul}}</td>
                                        <td>
                                            <img src="{{ env('APP_URL').$ft->image }}" width="200" alt="{{$ft->judul}}">
                                        </td>
                                        <td>

                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$ft->id}}"
                                              data-judul="{{$ft->judul}}"
                                              data-image="{{$ft->image}}"
                                           >
                                               <i class="fas fa-pen-square"></i> Edit</a>


                                            <form class="d-inline" method="post" role="alert" action="{{ route('foto.destroy', $ft->id) }}">
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
                <form id="add-form" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="row mr-3 ml-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul" name="judul" >
                                        <span id="errorJudul" class="error"></span>

                                    </div>
                              

                                    <div class="form-group">
                                        <label for="nama_rt">Foto</label>
                                        <input type="file" name="foto" id="foto" class="form-control">
                                        <span id="errorFoto" class="error"></span>
                                    </div>

                                
                                </div>   
                                <div class="col-md-6">
                                    <img id="fotoprev" src="https://placehold.co/400x400" width="400" height="400" alt="">
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
                    <h5 class="modal-title" id="addModalLabel">Edit Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="edit-judul" name="judul" >
                                <span id="edit-errorJudul" class="error"></span>

                            </div>
                      

                            <div class="form-group">
                                <label for="nama_rt">Foto</label>
                                <input type="file" name="foto" id="edit_foto" class="form-control">
                                <span id="edit-errorFoto" class="error"></span>
                            </div>

                        
                        </div>   
                        <div class="col-md-6">
                            <img id="edit_fotoprev" class="fotoprev" src="https://placehold.co/400x400" width="400" height="400" alt="">
                            <span id="lab-fotoprev"></span>
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
                    <h5 class="modal-title" id="addModalLabel">Detail Data RT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row mr-3 ml-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_rt">Kode RT</label>
                                <input type="text" class="form-control" id="detail-kode_rt" name="kode_rt" readonly>

                            </div>
                         

                            <div class="form-group">
                                <label for="nama_rt">Nama RT</label>
                                <input type="text" class="form-control" id="detail-nama_rt" name="nama_rt" readonly>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="detail-keterangan" name="keterangan" rows="3" readonly></textarea>
                             
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
    // Preview Foto
    foto.onchange = evt => {
    const [file] = foto.files
        if (file) {
            fotoprev.src = URL.createObjectURL(file)
        }
    }

    edit_foto.onchange = evt => {
    const [file] = edit_foto.files
        if (file) {
            edit_fotoprev.src = URL.createObjectURL(file)
        }
    }

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
      var form = $('#add-form')[0];
      var formData = new FormData(form);
      $.ajax({
          type: "POST",
          url: "{{ route('foto.store') }}",
          data: formData,
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          timeout: 600000,
          success: function (response) {

              if(response.errors)
              {
                  $('#errorJudul').text(response.errors.judul ? response.errors.judul[0]  : '');
                  $('#errorFoto').text(response.errors.foto ? response.errors.foto[0]  : '');

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
      $('#edit-judul').val($(this).data('judul'));
      $('#lab-fotoprev').html($(this).data('image'));
      
  });



  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();

      var form = $('#edit-form')[0];
      var formData = new FormData(form);

      var id = $('#edit-id').val();

      $.ajax({
          type: 'POST',
          url: '/webapp/foto/'+ id,
          data: formData,
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          timeout: 600000,
          success: function(response) {
          

              if(response.errors)
              {
                $('#edit-errorJudul').text(response.errors.judul ? response.errors.judul[0]  : '');
                  $('#edit-errorFoto').text(response.errors.foto ? response.errors.foto[0]  : '');

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

</script>
@endpush

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                // alert('Hallo');
                Swal.fire({
                    title: 'Hapus Foto',
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
