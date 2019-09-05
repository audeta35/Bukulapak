@extends('home.main')
@section('content')
<section class="content">
  <div class="row py-3">
    <div class="col-md-6">
      <ol class="breadcrumb float-sm-left bg-dark">
        <li class="breadcrumb-item"><a href="#" class="text-dark">Semua Barang</a></li>
      </ol>
    </div>

    <div class="col-md-6">
      <ol class="breadcrumb float-sm-right bg-dark">
        <li class="breadcrumb-item"><a href="#">Kategori</a></li>
        <li class="breadcrumb-item">Semua Kategori</li>
      </ol>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">


    @foreach($data as $barang)
      <div class="col-md-4 mt-2">

        <div class="card border-success mb-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="{{$barang->thumbnail}}" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><b class="h4">{{$barang->name}}</b></h5>
                 <a href="{{url('/details/'.$no++)}}" class="card-link">Detail</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    @endforeach

  </div>
</section>

@endsection
