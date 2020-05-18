@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="card">
      <div class="card-header" style="background-color: #20c997">
        <h3 class="card-title" style="color: white">Form Bukti Upload</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="card-body">
          <div class="col-md-12">
          <div class="form-group">
            <label>Member</label>
            <select class="form-control select2" name="member" id="member" required>
              <option value="">Pilih..</option>
              @foreach ($member as $m)
              <option value="{{ $m->userid }}">{{ $m->name }}</option>  
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="exampleInputFile">Upload Berkas</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="file" accept=".jpg,.jpeg,.png" required>
                <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 65px;" required></textarea>
          </div>
        </div>
        
          
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn" style="background-color: #20c997">Upload</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Bukti</h3>
        </div>
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Member</th>
              <th>Keterangan</th>
              <th>Photo</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($upload as $u)
            <tr>
              <td>{{ $u->created_at }}</td>
              <td>{{ $u->userid ? App\User::where('userid', $u->userid)->first() ? App\User::where('userid', $u->userid)->first()->name : '' : '' }}</td>
              <td>{{ $u->keterangan }}</td>
              <td><div class="col-sm-8">
                <a href="{{ url($u->foto) }}" data-toggle="lightbox" data-title="{{ $u->keterangan }}" data-gallery="gallery">
                  <img src="{{ url($u->foto) }}" class="img-fluid mb-2" alt="foto">
                </a>
              </div></td>
              <td>
                <a type="button" class="btn btn-sm btn-danger" href="{{ url('admin/upload/delete/'.$u->id) }}"
                ><i class="nav-icon fas fa-minus-square"></i></a>
              </td>
            </tr>
            @endforeach
            
            </tbody>
          </table>
        </div>
    </div>
  </div>
 
</div>
    
@endsection
@push('script')
    <script type="text/javascript">
      $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  });
    </script>
@endpush