<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Outlet;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index() {
        $outlet = Outlet::orderBy('nama', 'asc')->get();

        return view('pages.admin.laporan.index', compact('outlet'));
    }

    public function getTransaksi(Request $request) {

        $outlets = $request->input('outlet');
        $status = $request->input('status');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $transaksi = Transaksi::query();

        if ($outlets) {
            $transaksi->whereHas('outlet', function($q) use ($outlets){
                $q->where('id_outlet', $outlets);
            });

        }

        if ($status) {
            $transaksi->where('status', '=', $status);
        }

        if ($date_from) {
            $transaksi->where('tgl', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tgl', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }



        return view('pages.admin.laporan.index', [
            'transaksi' => $transaksi->get(),
            'from' => $date_from,
            'to' => $date_to,
            'outlets' => $outlets,
            'status' => $status,
            'outlet' => Outlet::orderBy('nama', 'asc')->get()

        ]);
    }

    public function export(Request $request) {

        $outlets = $request->input('outlet');
        $status = $request->input('status');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $transaksi = Transaksi::query();

        if ($outlets) {
            $transaksi->whereHas('outlet', function($q) use ($outlets){
                $q->where('id_outlet', $outlets);
            });

        }

        if ($status) {
            $transaksi->where('status', '=', $status);
        }

        if ($date_from) {
            $transaksi->where('tgl', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tgl', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        PDF::setOptions(['defaultFont' => 'sans-serif']);


        $pdf = PDF::loadView('pages.admin.laporan.export', [
            'transaksi' => $transaksi->get()
        ]);
        return $pdf->download('LAPORAN_transaksi_SPP.pdf');

    }
}
