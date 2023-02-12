<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $paket = Paket::get();



        // $jml_pkt = DB::table('paket')
        // ->selectRaw("outlet.id, COUNT('paket.id_outlet') as paketCount")
        // ->join('outlet', 'outlet.id', '=', 'paket.id_outlet')
        // ->groupBy('outlet.id')
        // ->get();

        // SELECT outlet.*, COUNT(outlet.id) AS jml FROM outlet LEFT JOIN paket ON outlet.id = paket.id_outlet GROUP BY paket.id_outlet

        // $outlet = Outlet::get();
        $outlet = Outlet::select('outlet.*', DB::raw('count(outlet.id) as jumlah'))
        ->leftJoin('paket', 'outlet.id', '=', 'paket.id_outlet')
        ->groupBy('paket.id_outlet')
        ->get();



        // SELECT paket.id, COUNT(outlet.id) AS jml FROM outlet INNER JOIN paket ON outlet.id = paket.id_outlet GROUP BY paket.id_outlet

        return view('pages.admin.paket.index', compact('outlet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::orderBy('nama', 'asc')->get();
        return view('pages.admin.paket.create', compact('outlet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nama_paket' => 'required',
            'id_outlet' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);


        Paket::create($request->all());

        Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
        return redirect()->route('data-paket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket = Paket::where('id_outlet', $id)->get();

        // dd($paket);
        // $paket = Outlet::where('id', $id)->first();

        return view('pages.admin.paket.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = Paket::find($id);
        return view('pages.admin.paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_paket' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);


        $paket = Paket::find($id);
        $paket = $paket->update($request->all());

        Alert::success('Berhasil!', 'Data Berhasil Diubah');
        return redirect()->route('data-paket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paket::find($id)->delete();

        Alert::success('Berhasil!', 'Data Berhasil Dihapus');

        return back();
    }
}
