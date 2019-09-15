<?php

namespace App\Http\Controllers;

use App\Rekening;
use App\Invoice;
use App\User;
use Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['coorp'] = "Bukulapak";
      $data['admin'] = Rekening::where('users_id', Auth::user()->id)->get();
      $data['invoice'] = Invoice::where('users_id', Auth::user()->id)->get();
      return view('home.invoice', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
      $request->validate([

        'product' => 'required',
        'product_weight' => 'required',
        'product_etd' => 'required',
        'product_total' => 'required',
        'product_value' => 'required',

        'courier' => 'required',

        'buyer' => 'required',
        'buyer_city' => 'required',
        'buyer_province' => 'required',
        'postal_code' => 'required',
        'buyer_address' => 'required',

        'total' => 'required',

      ]);

      $buyer = User::where('id', $id)->get();
      $buyer = $buyer[0];

      if (isset($request->rekening)) {

        $rekening = Rekening::where('nomor_rekening', $request->rekening)->get();
        $rekening = $rekening[0];

        $bill = $request->product_value + $request->total;

        Invoice::create([

          'users_id' => $id,

          'buyer_name' => $buyer->name,
          'buyer_email' => $buyer->email,
          'buyer_address' => $request->buyer_address,
          'buyer_city' => $request->buyer_city,
          'buyer_province' => $request->buyer_province,

          'postal_code' => $request->postal_code,

          'account' => $rekening->nomor_rekening,
          'account_name' => $rekening->pemilik_rekening,
          'account_bank' => $rekening->bank,

          'product' => $request->product,
          'product_weight' => $request->product_weight,
          'product_total' => $request->product_total,
          'product_value' => $request->product_value,

          'courier_name' => $request->courier,
          'courier_value' => $request->total,
          'courier_service' => '',
          'courier_etd' => '',

          'additional_cost' => $request->product_etd,
          'total_bill' => $bill,
          'status' => 'Menunggu Pembayaran'


        ]);
      }

      return redirect(url('/invoice'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
