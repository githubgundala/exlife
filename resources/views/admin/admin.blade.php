@extends('layouts.layout')
@section('menAdmin','active')
@section('content')
<div class="row">
<div class="card col-md-12">
  <div class="card-header">
    <h3 class="card-title">Data List Admin</h3>
    @if ($count <= 3)
    @auth('admin')
    <button type="button" class="btn btn-sm float-right" data-toggle="modal" data-target="#modal-edit" style="background-color: #20c997" onclick="modalinsert()"><i class="nav-icon fas fa-plus"></i>
    </button>
    @endauth
    @endif
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($admin as $a)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $a->name }}</td>
          <td>{{ $a->email }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit"
            data-id="{{ $a->id }}"
            data-name="{{ $a->name }}"
            data-email="{{ $a->email }}"
            ><i class="nav-icon fas fa-edit"></i></button>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus"
            data-id="{{ $a->id }}"
            data-name="{{ $a->name }}"
            ><i class="nav-icon fas fa-minus-square"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
</div>
<!-- /.card -->

{{-- modal --}}
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title titleEdit">Edit Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="POST" action="" id="insertform">
        @csrf
        <div class="modal-body">
            <div class="card-body">
              <input type="hidden" value="" name="id">
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn" style="background-color: #20c997">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-hapus">
  <div class="modal-dialog">
    <form action="" method="POST">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="nam">Nama User&hellip;</p>
        <input type="hidden" name="id" value="">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function () {
  $('#example1 tbody').on('click', '.btn-warning', function () {
    $('.modal-body').find("input,textarea,select").val('').removeClass('is-invalid').end();
      $('.titleEdit').html('Edit Admin');
      $('.modal-body input[name="name"]').val($(this).data("name"));
      $('.modal-body input[name="email"]').val($(this).data("email"));
      $('.modal-body input[name="id"]').val($(this).data("id"));
      $('form').attr('action', "{{ url('/admin/update') }}");
  });
  $('#example1 tbody').on('click', '.btn-danger', function () {
      $('.nam').html($(this).data("name"));
      $('.modal-body input[name="id"]').val($(this).data("id"));
      $('form').attr('action', "{{ url('/admin/delete') }}");
  });
});

$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
  });
  function modalinsert(){
    // reset field modal
    $('.modal-body').find("input,textarea,select").val('').removeClass('is-invalid').end()
    .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();

      $('.titleEdit').html('Input Admin');
      $('form').attr('action', "{{ url('/admin/create') }}");
    
      jQuery.extend(jQuery.validator.messages, {
        required: "Tidak boleh kosong !",
        email: "Format email tidak sesuai !",
        // fullname: fullname,
        remote: jQuery.validator.format("{0} sudah tersedia !"),
        // equalTo: "Samakan dengan password !",
        maxlength: jQuery.validator.format("Max {0} karakter !"),
        minlength: jQuery.validator.format("Min {0} karakter !"),
    });

    // $.validator.setDefaults({
    //   submitHandler: function () {
    //     console.log("Form successful submitted!");
    //     // alert( "Form successful submitted!" );
    //   }
    // });
    $('#insertform').validate({
      rules: {
        name:{
          required: true,
          minlength: 3,
        },
        alamat:{
          required: true,
          minlength: 3,
        },
        password:{
          required: true,
          minlength: 6,
        },
        email: {
          required: true,
          email: true,
          remote: {
              url: "{{ url('checkemail') }}",
              type: "post",
              data: {
                  email: function () {
                      return $('input[name="email"]').val();
                  }
              }
          }
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  }
</script>
@endpush