<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
