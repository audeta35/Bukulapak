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
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none">{{$detail->name}}</h3>
          <div class="col-12">
            <img src="{{$detail->thumbnail}}" class="product-image img-fluid" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="h3"><b>{{$detail->name}}</b></h3>
          <hr>

          <ul class="list-group">
            <li class="list-group-item">Authors : <b>@if(isset($detail->authors[0]->title)) {{$detail->authors[0]->title}} @else <span class="badge badge-danger">unknown</span> @endif</b></li>
            <li class="list-group-item">Tipe : <b>{{$detail->formats[0]->type}}</b></li>
            <li class="list-group-item">Berat (gram) : <b>{{$detail->formats[0]->weight}}</b></li>
            <li class="list-group-item">Stok Tersedia : <b>{{$detail->formats[0]->stockLevel}}</b></li>
            <li class="list-group-item">Jenis :
              @foreach($detail->categories as $kategori)
                <span class="badge badge-danger">{{$kategori->title}}</span>
              @endforeach
            </li>
          </ul>

          <div class="bg-gray py-2 px-3 mt-4">
            <h2 class="mb-0">
              Rp. {{number_format($detail->formats[0]->basePrice)}}
            </h2>
          </div>

          <hr>

          <form class="" action="index.html" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pilih Jumlah</label>
                  <input type="number" class="form-control" min="0" max="{{$detail->formats[0]->stockLevel}}" name="jml" placeholder="jumlah pembelian">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pilih Kurir :</label>

                  <select id="kurir" class="form-control select2" name="kurir">

                    <option value=""></option>

                    <option value="jne">JNE</option>
                    <option value="pos">POS INDONESIA</option>
                    <option value="tiki">TIKI</option>

                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Pilih Kota Tujuan</label>
                  <select class="custom-select select2" id="kotaTujuan" style="width: 100%;">
                    <option></option>
                    @foreach($kota as $city)
                      <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Catatan Pembeli</label>
                  <textarea name="catatan" class="form-control" rows="3" cols="80"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mt-4">
                  <buttton class="btn btn-outline-danger btn-lg btn-flat">
                    <i class="fas fa-shopping-cart fa-lg mr-2"></i>
                    Hitung & Bayar
                  </buttton>

                  <div class="btn btn-outline-danger btn-lg btn-flat float-right">
                    <i class="fas fa-shopping-bag fa-lg mr-2"></i>
                    Tambah Ke Keranjang
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>


@endsection
