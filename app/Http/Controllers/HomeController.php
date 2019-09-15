<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rekening;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
      $curl = curl_init();
      $url = "https://www.gramedia.com/api/products/";

      curl_setopt($curl, CURLOPT_URL, $url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($curl);
      $json = json_decode($result);

      $data['data'] = $json;
      $data['no'] = 0;

      return view('home.all', $data);
    }

    public function details($id)
    {
      $curl = curl_init();
      $url = "https://www.gramedia.com/api/products/";

      curl_setopt($curl, CURLOPT_URL, $url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($curl);
      $json = json_decode($result);

      $data['detail'] = $json[$id];
      $data['id'] = $id;

      curl_close($curl);

      $curls = curl_init();
      $param = "city";
      $key = "87bbe92f50ba11d09fc0d91e9db4fe04";
      $id = "";
      $url = "https://api.rajaongkir.com/starter/".$param."?key=".$key."&id=".$id;

      curl_setopt($curls, CURLOPT_URL, $url);

      curl_setopt($curls, CURLOPT_RETURNTRANSFER, 1);

      $results = curl_exec($curls);

      $kota = json_decode($results);
      $kota = $kota->rajaongkir;
      $kota = $kota->results;

      $data['kota'] = $kota;

      curl_close($curls);

      return view('home.details', $data);
    }

    public function count(Request $request)
    {
      $request->validate([

        'id' => 'required',
        'kota_tujuan' => 'required',
        'kurir' => 'required'

      ]);


      $curls = curl_init();
      $url = "https://www.gramedia.com/api/products/";

      curl_setopt($curls, CURLOPT_URL, $url);

      curl_setopt($curls, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($curls);
      $json = json_decode($result);

      $detail = $json[$request->id];
      $data['biaya_tambahan'] = 2000;
      $data['angka'] = $detail->formats[0]->basePrice;
      $data['nama'] = $detail->name;
      $data['id'] = $request->id;
      $data['jml'] = $request->jml;
      $data['harga_pcs'] = $detail->formats[0]->basePrice;
      $data['harga'] = $data['angka'] * $request->jml + $data['biaya_tambahan'];
      $data['berat'] = $detail->formats[0]->weight * $request->jml;
      $data['catatan'] = $request->catatan;

      if($data['berat'] < 1){

        $data['berat'] = '1';

      }

      curl_close($curls);
      // -------------------------- -------- rajaongkir

      $curl = curl_init();
      $param = "cost";
      $key = "87bbe92f50ba11d09fc0d91e9db4fe04";
      $kota_asal = '152';
      $kota_tujuan = $request->kota_tujuan;
      $berat = $data['berat'];
      $kurir = $request->kurir;

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/".$param,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir,
        CURLOPT_HTTPHEADER => array(
          "content-type: application/x-www-form-urlencoded",
          "key: ".$key
        ),
      ));

      $response = curl_exec($curl);
      $hasil = json_decode($response);
      $rajaongkir = $hasil->rajaongkir;

      $user_id = Auth::user()->id;
      $data['rekening_user'] = Rekening::where('users_id', $user_id)->get();

      $data['kota_asal'] = $rajaongkir->origin_details;
      $data['kota_tujuan'] = $rajaongkir->destination_details;
      $data['ongkir'] = $rajaongkir->results;

      return view('home.result', $data);
    }

    public function setting()
    {
      return view('home.pengaturan');
    }
}
