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

      return view('home.details', $data);
    }
}
