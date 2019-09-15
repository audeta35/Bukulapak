@extends('layouts.main')
@section('content')
<!-- Main content -->
<section class="content mt-2">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-id-card mr-2"></i> Data Rekening {{$rekening}}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-borderless table-hover" id="{{$rekening}}">
          <thead>
            <tr>
              <th>#</th>
              <th>Pemilik</th>
              <th>Bank</th>
              <th>Nomor Rekening</th>
            </tr>
          </thead>

          <tbody>
            @foreach($data as $info)
             <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$info->pemilik_rekening}}</td>
               <td>{{$info->bank}}</td>
               <td>{{$info->nomor_rekening}}</td>
             </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection
