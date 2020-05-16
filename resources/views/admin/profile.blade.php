@extends('layouts.layout')
@section('menProfile','active')
@section('content')
<!-- general form elements -->
<div class="col-md-6">
<div class="card">
  <div class="card-header" style="background-color: #20c997">
    <h3 class="card-title">Profile</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" action="{{ url('admin/update') }}" method="POST">
    @csrf
    <input type="hidden" value="{{ Auth::guard('admin')->user()->id }}" name="id">
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->name }}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
</div>
<!-- /.card -->
@endsection