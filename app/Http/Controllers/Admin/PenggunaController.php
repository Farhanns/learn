<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use App\Models\Outlet;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = User::get();
        return view('pages.admin.pengguna.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::orderBy('nama', 'asc')->get();
        return view('pages.admin.pengguna.create', compact('outlet'));
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
            'nama' => 'required',
            'username' => 'required',
            'role' => 'required',
            'password' => 'required',
            'id_outlet' => 'required',
        ]);

        $user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'id_outlet' => $request->id_outlet,

        ];

        User::create($user);

        Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
        return redirect()->route('data-pengguna.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::orderBy('nama', 'asc')->get();
        $pengguna = User::find($id);
        return view('pages.admin.pengguna.edit', compact('pengguna', 'outlet'));
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
            'nama' => 'required',
            'username' => 'required',
        ]);

        $user = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'id_outlet' => $request->id_outlet,

        ];


        $pengguna = User::find($id);
        $pengguna = $pengguna->update($user);

        Alert::success('Berhasil!', 'Data Berhasil Diubah');
        return redirect()->route('data-pengguna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        Alert::success('Berhasil!', 'Data Berhasil Dihapus');

        return back();
    }
}
