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
  <hr class="mt-3">
  <h1 class="text-muted text-center">Pilih Durasi Pengiriman</h1>
  <hr>
  <div class="row mt-3 mb-5">

    <div class="col-md-6">
      <table class="table table-bordered table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Jenis Layanan</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Waktu Pengiriman</th>
            <th scope="col">Biaya</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ongkir[0]->costs as $kurir): ?>
            <tr>
              <td><?= $kurir->service ?></td>
              <td><?= $kurir->description ?></td>
              <td>(<?= $kurir->cost[0]->etd ?>) hari</td>
              <td>
                <span class="badge badge-dark">Rp. {{number_format($kurir->cost[0]->value)}}</span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>

    <div class="col-md-6">
      <ul class="list-group">
        <li class="list-group-item">Kurir : <b><?= $ongkir[0]->name ?></b></li>
        <li class="list-group-item">
          <form class="" action="{{url('/invoice/'.Auth::user()->id)}}" method="post">
            @csrf

            <input type="hidden" name="product" value="{{$nama}}">
            <input type="hidden" name="product_weight" value="{{$berat}}">
            <input type="hidden" name="product_etd" value="{{$biaya_tambahan}}">
            <input type="hidden" name="product_total" value="{{$jml}}">
            <input type="hidden" name="product_value" value="{{$harga}}">

            <input type="hidden" name="courier" value="{{$ongkir[0]->name}}">

            <input type="hidden" name="buyer" value="{{Auth::user()->name}}">
            <input type="hidden" name="buyer_city" value="{{$kota_tujuan->city_name}}">
            <input type="hidden" name="buyer_province" value="{{$kota_tujuan->province}}">
            <input type="hidden" name="postal_code" value="{{$kota_tujuan->postal_code}}">
            <input type="hidden" name="buyer_address" value="{{$catatan}}">

            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label>Pilih Durasi</label>
                  <select id="total" class="form-control select2" name="total">
                    <option value=""></option>

                    @foreach($ongkir[0]->costs as $biaya)
                      <option value="{{$biaya->cost[0]->value}}">
                        ({{$biaya->service}}) Total : <i class="text"> Rp.{{number_format($biaya->cost[0]->value + $harga)}}</i>
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Rekening
                    <span class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="Opsional, Jika anda mengisi sesuai dengan rekening yang digunakan untuk proses pembayaran, maka kemungkinan besar dapat mempercepat proses konfirmasi dari tim kami"><i class="fas fa-info-circle fa-sm"></i></span>
                  </label>
                  <select id="rekening" class="form-control select2" name="rekening">
                    <option value=""></option>

                    @foreach($rekening_user as $rekening)
                      <option value="{{$rekening->nomor_rekening}}">{{$rekening->nomor_rekening}} - {{$rekening->pemilik_rekening}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  @if(isset(Auth::user()->name))
                    <button type="submit" class="float-right btn btn-block btn-dark btn-flat"><i class="fas mr-2 fa-money-check-alt"></i> Bayar</button>
                  @else
                    <a href="{{ route('login') }}"class="float-right btn btn-block btn-dark btn-flat"><i class="fas mr-2 fa-sign-in-alt"></i> Login Untuk Melanjutkan Ke Pembayaran</a>
                  @endif

                </div>
              </div>

            </div>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <div class="row  mt-3">
    <div class="col-md-6">
      <h4 class="text-muted text-center">Detail Pembelian</h4>
      <hr>
      <ul class="list-group">
        <li class="list-group-item">Barang : <b>{{$nama}}</b></li>
        <li class="list-group-item">Jumlah : <b>{{number_format($jml)}}</b></li>
        <li class="list-group-item">Total Berat : <b>{{$berat}}</b>
          <span class="badge badge-light">gram</span>
        </li>
        <li class="list-group-item">Harga Satuan :
          <span class="badge badge-light">{{number_format($harga_pcs)}} / pcs</span>
        </li>
        <li class="list-group-item">Biaya Tambahan :
          <span class="badge">Rp. {{number_format($biaya_tambahan)}}</span>
        </li>
        <li class="list-group-item">Total Biaya <i>(belum termasuk ongkir)</i> :
          <span class="badge badge-dark">Rp. {{number_format($harga)}}</span>
        </li>
      </ul>
    </div>

    <div class="col-md-6">
      <h4 class="text-muted text-center">Detail Pengiriman</h4>
      <hr>
      <ul class="list-group">
        <li class="list-group-item">Kota : <b><?= $kota_tujuan->city_name ?></b></li>
        <li class="list-group-item">Provinsi : <b><?= $kota_tujuan->province ?></b></li>
        <li class="list-group-item">Kode Pos : <b><?= $kota_tujuan->postal_code ?></b></li>
        <li class="list-group-item">Alamat Pembeli
          <hr>
          <p><b>{{$catatan}}</b></p>
        </li>
      </ul>
    </div>
  </div>
</section>

@endsection
