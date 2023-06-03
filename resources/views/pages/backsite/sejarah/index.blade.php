@extends('layouts.app')
@section('title', 'Sejarah')
@section('content')

{{--    <div class="loading"></div>--}}
    <!-- BEGIN: Content-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sejarah
                        </h1>
              
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <li class="breadcrumb-item active">Sejarah</li>
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

                      
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th >Sejarah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sejarah as $dsd)
                                    <tr>
                                        <td width="70%" style="text-align: justify">{!! $dsd->sejarah !!}</td>
                                        <td>
                                           <a href="#" class="btn btn-success edit-item" data-toggle="modal"
                                              data-target="#editModal"
                                              data-id="{{$dsd->id}}"
                                              data-sejarah="{{$dsd->sejarah}}"
                                           >
                            
                                               <i class="fas fa-pen-square"></i> Edit</a>

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



{{-- Edit  Modal--}}
<div class="row">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 68%;">
         <form id="edit-form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Edit Sejarah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="periodeawal">Sejarah</label>
                            <textarea class="ckeditor form-control" id="edit-sejarah"  cols="30" rows="10" name="sejarah"></textarea>
                            <span id="edit-errorSejarah" class="error"></span>
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
@push('javascript-internal')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endpush

{{-- Datatabel --}}
@push('javascript-internal')
<script>
  $(document).ready(function() {
       $('.ckeditor').ckeditor();
  });

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


//  Edit Ajax
  $('.edit-item').click(function() {
      $('#edit-id').val($(this).data('id'));
      CKEDITOR.instances['edit-sejarah'].setData($(this).data('sejarah'));
  });


    //  Detail Ajax
  $('.detail-item').click(function() {
      $('#detail-sejarah').val($(this).data('sejarah'));
  });

  //Updated
  $('#edit-form').submit(function(e) {
      e.preventDefault();

      var sejarah = CKEDITOR.instances['edit-sejarah'].getData();
      var id = $('#edit-id').val();

      $.ajax({
          type: 'PUT',
          url: '/webapp/sejarah/'+ id,
          data: {
            id : id,
            sejarah: sejarah            
          },
          success: function(response) {
            if(response.errors)
              {
                  $('#edit-errorSejarah').text(response.errors.sejarah ? response.errors.sejarah[0]  : '');

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
