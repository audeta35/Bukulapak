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
        <div class="col-12 col-md-6">
          <h3 class="d-inline-block d-sm-none">{{$detail->name}}</h3>
          <div class="col-12">
            <a href="#" class="btn btn-block mb-auto btn-flat btn-outline-dark mt-3 btn-lg float-right">
              <i class="fas fa-shopping-bag fa-lg mr-2"></i>
              Tambah Ke Keranjang
            </a>
            <img src="{{$detail->thumbnail}}" class="product-image img-fluid" alt="Product Image">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <h3 class="h3 mt-2"><b>{{$detail->name}}</b></h3>
          <hr>

          <ul class="list-group">
            <li class="list-group-item">Authors : <b>@if(isset($detail->authors[0]->title)) {{$detail->authors[0]->title}} @else <span class="badge badge-dark">unknown</span> @endif</b></li>
            <li class="list-group-item">Tipe : <b>{{$detail->formats[0]->type}}</b></li>
            <li class="list-group-item">Berat : <b>{{$detail->formats[0]->weight}}</b>
              <span class="badge">gram</span>
            </li>
            <li class="list-group-item">Stok Tersedia : <b>{{$detail->formats[0]->stockLevel}}</b></li>
            <li class="list-group-item">Jenis :
              @foreach($detail->categories as $kategori)
                <span class="badge badge-dark">{{$kategori->title}}</span>
              @endforeach
            </li>
          </ul>

          <div class="bg-gray py-2 px-3 mt-4">
            <h2 class="mb-0">
              Rp. {{number_format($detail->formats[0]->basePrice)}}
            </h2>
          </div>

          <hr>

          <form class="" action="{{url('/details')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pilih Jumlah</label>
                  <select id="jml" class="form-control select2" name="jml">

                    <option></option>

                    @for($i = 1; $i <= $detail->formats[0]->stockLevel; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pilih Kurir</label>
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
                  <select class="custom-select select2" name="kota_tujuan" id="kotaTujuan" style="width: 100%;">
                    <option></option>
                    @foreach($kota as $city)
                      <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Alamat Pembeli</label>
                  <textarea name="catatan" name="catatan" placeholder="Alamat dibuat sejelas mungkin agar memudahkan kurir mengantar barang ke tempat tujuan" class="form-control" rows="3" cols="80"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mt-2">
                  <button type="submit" class="btn btn-block btn-outline-dark btn-flat mt-3 btn-lg">
                    <i class="fas fa-shopping-cart fa-lg mr-2"></i>
                    Hitung & Bayar
                  </button>
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
