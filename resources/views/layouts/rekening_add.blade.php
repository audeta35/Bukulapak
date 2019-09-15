@extends('layouts.main')
@section('content')
<!-- Main content -->
<section class="content col-md-9">
  <br>
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-credit-card"></i> Form Tambah Rekening
      </h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <form action="{{url('/rekening/store')}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Admin</label>
              <select class="form-control select2" id="administrator" name="admin">
                <option value=""></option>
                @foreach($user as $admin)
                  <option value="{{$admin->id}}">{{$admin->name}} - {{$admin->email}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Pemilik Rekening</label>
              <input type="text" name="pemilik" class="form-control" placeholder="Nama Pemilik Rekening">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Bank</label>
              <select class="form-control select2" id="bank" name="bank">
                <option value=""></option>

                @foreach($bank as $data)
                  <option value="{{$data->name}}">{{$data->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Rekening</label>
              <input type="number" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening">
            </div>
          </div>

          <div class="col-md-12 mt-3">
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-block btn-dark">
                <i class="fas fa-plus"></i>  Tambah Rekening
               </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection
