<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\User;
use App\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index($level)
    {
      if($level == 'admin'){


        $data['data'] = Rekening::where('is_admin', '1')->get();
        $data['rekening'] = $level;
        return view('layouts.rekening', $data);

      }

      elseif($level == 'user'){

        $data['data'] = Rekening::where('is_admin', '0')->get();
        $data['rekening'] = $level;
        return view('layouts.rekening', $data);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level == 'admin') {

          $bank = Storage::disk('local')->get('bank.json');

          $json = json_decode($bank);
          $data['bank'] = $json;
          $data['user'] = User::where('level', 'admin')->get();

          return view('layouts.rekening_add', $data);

        } else {

          return view('home.rekening_add', $data);

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([

        'admin' => 'required',
        'pemilik' => 'required',
        'bank' => 'required',
        'nomor_rekening' => 'required'

      ]);

      if(Auth::user()->level == 'admin')
      {
        $is_admin = "ini rekening admin";
      }

      Rekening::create([

        'users_id' => Auth::user()->id,
        'nomor_rekening' => $request->nomor_rekening,
        'bank' => $request->bank,
        'pemilik_rekening' => $request->pemilik,
        'status_rekening' => 'active',
        'is_admin' => isset($is_admin)

      ]);

      return redirect(url('/'))->with('status', 'rekening berhasil di tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekening $rekening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        //
    }
}
