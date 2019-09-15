@extends('home.main')
@section('content')
<section class="content">
  <div class="container-fluid">
    <br>
    <br>
    <div class="row">
      @foreach($invoice as $bill)
      <div class="col-12">

        <div class="card collapsed-card">
          <div class="card-header">
            <h3 class="card-title"><b>#{{$loop->iteration}} Invoice : </b>
              <span class="badge badge-dark">Rp.{{number_format($bill->total_bill)}}</span>
              /
              <span class="badge badge-light"><i class="far fa-user"></i> {{$bill->buyer_name}}</span>
              /
              @if ($bill->status == 'Menunggu Pembayaran')
                <span class="badge badge-warning text-light">{{$bill->status}}</span>
              @elseif ($bill->status == 'Proses')
                <span class="badge badge-primary">{{$bill->status}}</span>
              @elseif($bill->status == 'Pengiriman')
                <span class="badge badge-success">{{$bill->status}}</span>
              @else
                <span class="badge badge-dark">{{$bill->status}}</span>
              @endif
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-plus"></i></button>
            </div>
          </div>
          <div class="card-body">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12 mb-2">
                  <h4>
                    <i class="fas fa-globe"></i> {{$coorp}} Store
                    <small class="float-right"><i>{{$bill->created_at}}</i></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$coorp}}</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$bill->buyer_name}}</strong>
                    <p>
                      {{$bill->buyer_address}},
                      <b>{{$bill->buyer_city}}</b>,
                      <b>{{$bill->buyer_province}}</b>
                      <br>{{$bill->postal_code}}
                    </p>
                  </address>
                </div>

                <div class="col-sm-4 invoice-col">
                  Informasi Rekening
                  <br>
                  <br>
                  <b>{{$bill->account_name}}</b>
                  <br>
                  <b>{{$bill->account_bank}}</b><br>
                  <b>{{$bill->account}}</b><br>
                </div>
                <!-- /.col -->

                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped daftar_beli">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Berat</th>
                        <th>Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for($i=1;$i<=$bill->product_total; $i++)
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$bill->product}}</td>
                          <td>
                            <span class="badge badge-light">{{number_format($bill->product_weight / $bill->product_total, 1)}} gram</span>
                          </td>
                          <td>Rp.{{number_format($bill->product_value / $bill->product_total - $bill->additional_cost)}}</td>
                        </tr>
                      @endfor
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row mt-2">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">
                    <b>Transfer ke rekening berikut
                      <span class="badge badge-light">pilih salah satu</span>
                    </b>
                  </p>

                  <div class="table-responsive">
                    <table class="table table-borderless rekening_admin">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Pemilik Rekening</th>
                          <th>Bank</th>
                          <th>No. Rek</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($admin as $rek)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$rek->pemilik_rekening}}</td>
                          <td>{{$rek->bank}}</td>
                          <td>{{$rek->nomor_rekening}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Jumlah harga produk</th>
                        <td>
                          <span class="badge badge-dark">Rp.{{number_format($bill->product_value - $bill->additional_cost)}}</span>
                        </td>
                      </tr>
                      <tr>
                        <th>Biaya Tambahan</th>
                        <td>
                          <span class="badge badge-dark">Rp.{{number_format($bill->additional_cost)}}</span>
                        </td>
                      </tr>
                      <tr>
                        <th>Berat Total</th>
                        <td>
                          <span class="badge badge-dark">{{number_format($bill->product_weight)}} gram</span>
                        </td>
                      </tr>
                      <tr>
                        <th>Ongkir:</th>
                        <td>
                          <span class="badge badge-dark">Rp.{{number_format($bill->courier_value)}}</span>
                        </td>
                      </tr>
                      <tr>
                        <th>Jumlah Pembayaran:</th>
                        <td>
                          <b>Rp.{{number_format($bill->total_bill)}}</b>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Upload Struk Pembayaran
                  </button>
                  <button type="button" class="btn btn-danger float-left" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Batalkan Pemesanan
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <span class="badge badge-light">
              <p>
                jika sudah melakukan pembayaran, harap upload bukti transfer untuk mempercepat proses konfirmasi oleh toko kami
              </p>
            </span>
          </div>
          <!-- /.card-footer-->
        </div>
      </div><!-- /.col -->
      @endforeach
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
