@extends('layouts.layout')
@section('menMember','active')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data List Member</h3>
    <button type="button" class="btn btn-sm float-right" data-toggle="modal" data-target="#modal-edit" style="background-color: #20c997" onclick="modalinsert()"><i class="nav-icon fas fa-plus"></i></button>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Jenis Member</th>
        <th>Rekomendasi Dari</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($member as $m)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="member/info/{{ $m->userid }}">{{ $m->userid }}</a></td>
        <td style="width: 500px">{{ $m->name }}</td>
        <td>{{ $m->alamat }}</td>
        <td>{{ $m->email }}</td>
        <td>{{ $m->hp }}</td>
        <td>{{ $m->jenis_member }}</td>
        <td>{{ $m->rekomendasi ? App\User::where('userid', $m->rekomendasi)->first() ? App\User::where('userid', $m->rekomendasi)->first()->name : '' : '' }}</td>
        <td>
          <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit"
            data-id="{{ $m->id }}"
            data-userid="{{ $m->userid }}"
            data-name="{{ $m->name }}"
            data-alamat="{{ $m->alamat }}"
            data-hp="{{ $m->hp }}"
            data-email="{{ $m->email }}"
            data-jenis_member="{{ $m->jenis_member }}"
            data-rekomendasi="{{ $m->rekomendasi }}"
            ><i class="nav-icon fas fa-edit"></i></button>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus"
            data-id="{{ $m->id }}"
            data-name="{{ $m->name }}"
            ><i class="nav-icon fas fa-minus-square"></i></button>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

{{-- modal --}}
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
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="username">Alamat</label>
                  <input type="text" class="form-control" id="alamat" placeholder="Alamat lengkap" name="alamat" value="" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPassword1">Password</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="" placeholder="Password">
                    <div class="input-group-append">
                      <span class="input-group-text"><i id="icon" class="fas fa-eye-slash" style="cursor: pointer;" onclick="hideshow()"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="username">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="username">HP</label>
                  <input type="number" class="form-control" id="HP" placeholder="0897xxxxxx" name="hp" value="" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Jenis Member</label>
                  <select class="form-control" name="jenis_member" id="jenis">
                    <option value="" selected>Pilih...</option>
                    <option value="Gold">Gold</option>
                    <option value="Silver">Silver</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Rekomendasi dari</label>
                  <select class="form-control select2" name="rekomendasi" id="rekomendasi">
                    <option value="-">Pilih..</option>
                    @foreach ($member as $m)
                    <option value="{{ $m->userid }}">{{ $m->name }}</option>  
                    @endforeach
                  </select>
                </div>
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
        <h4 class="modal-title">Hapus Member</h4>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      // "autoWidth": true,
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#example1 tbody').on('click', '.btn-warning', function () {
      $('.modal-body').find("input,textarea,select").val('').removeClass('is-invalid').end();
        $('.titleEdit').html('Edit Member');
        $('.pass').show();
        $('.modal-body input[name="name"]').val($(this).data("name"));
        $('.modal-body input[name="alamat"]').val($(this).data("alamat"));
        $('.modal-body input[name="email"]').val($(this).data("email"));
        $('.modal-body input[name="hp"]').val($(this).data("hp"));
        $('.modal-body input[name="username"]').val($(this).data("userid"));
        $(".modal-body #jenis").val($(this).data("jenis_member"));
        $(".modal-body #rekomendasi").val($(this).data("rekomendasi")).change();
        $('.modal-body input[name="id"]').val($(this).data("id"));
        $('form').attr('action', "{{ url('/admin/member/update') }}");
    });
    $('#example1 tbody').on('click', '.btn-danger', function () {
        $('.nam').html($(this).data("name"));
        $('.modal-body input[name="id"]').val($(this).data("id"));
        $('form').attr('action', "{{ url('/admin/member/delete') }}");
    });
  });

  function hideshow(){
    var cl = $('#icon').attr('class');
    if(cl == "fas fa-eye-slash")
    {
      $('#icon').attr('class','fas fa-eye');
      $('input[name="password"]').attr('type','text');
    }else{
      $('#icon').attr('class','fas fa-eye-slash');
      $('input[name="password"]').attr('type','password');
    }
  }

    function modalinsert(){
      $('.pass').hide();
      // reset field modal
      $('.modal-body').find("input,textarea,select").val('').removeClass('is-invalid').end()
      .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
  
        $('.titleEdit').html('Input Member');
        $('form').attr('action', "{{ url('/admin/member/create') }}");
      
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
      //     form.submit();
      //     // alert( "Form successful submitted!" );
      //   }
      // });
      $('#insertform').validate({
        rules: {
          name:{
            required: true,
            minlength: 3,
          },
          hp:{
            required: true,
            minlength: 11,
          },
          email: {
          email: true,
          remote: {
              url: "{{ url('checkemailmember') }}",
              type: "post",
              data: {
                  email: function () {
                      return $('input[name="email"]').val();
                  }
              }
          }
        },
          username:{
            required: true,
            minlength: 8,
            maxlength: 8,
            remote: {
              url: "{{ url('checkusername') }}",
              type: "post",
              data: {
                username: function () {
                      return $('input[name="username"]').val();
                  }
              }
          }
          },
          password:{
            required: true,
            minlength: 8,
            maxlength: 8,
          },
          jenis_member:{
            required: true,
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