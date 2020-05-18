@extends('layouts.layout')
@section('content')
<div class="row">
  <div class="col-md-6">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header" style="background-color: #20c997">
        <h3 class="widget-user-username" style="color: white">{{ $member->name }}</h3>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ url('template/dist/img/avatar5.png') }}" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">REKOMENDASI DARI</h5>
              <span class="description-text">{{ $pic ? $pic->name : '' }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">FOLLOWERS</h5>
              <span class="description-text">{{ $count }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">JENIS MEMBER</h5>
              <span class="description-text">{{ $member->jenis_member }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        
            <table class="table">
              <tbody>
                <tr>
                  <td>Alamat</td>
                  <td>: {{ $member->alamat }}</td>
                </tr>
                <tr>
                  <td>No HP</td>
                  <td>: {{ $member->hp }}</td>
                </tr>
              </tbody>
            </table>
          
        
        
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">List Follower</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Nama Follower</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($follower as $f)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ url('admin/member/info/'.$f->userid) }}">{{ $f->name }}</a></td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
    <div class="card-header">
      <h3 class="card-title">List Bukti</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
          <th>Photo</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($bukti as $u)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $u->created_at }}</td>
              <td>{{ $u->keterangan }}</td>
              <td><div class="col-sm-8">
                <a href="{{ url($u->foto) }}" data-toggle="lightbox" data-title="{{ $u->keterangan }}" data-gallery="gallery">
                  <img src="{{ url($u->foto) }}" class="img-fluid mb-2" alt="foto">
                </a>
              </div></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
</div>

@endsection
@push('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": true,
    });
  });
</script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    // $('.btn[data-filter]').on('click', function() {
    //   $('.btn[data-filter]').removeClass('active');
    //   $(this).addClass('active');
    // });
  });
</script>
@endpush