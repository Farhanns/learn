<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')->get();
        $member = Member::orderBy('nama', 'asc')->get();


        return view('pages.admin.transaksi.index', compact('transaksi', 'member'));
    }

    public function cariMember($id)
    {
        $member = Pelanggan::find($id);

        return $member;
    }

    public function jsonStatus($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();

        return $transaksi;
    }

    public function statusUpdate(Request $request, $id)
    {
        $jquin = [
            'status' => $request->status_pesanan,
        ];

        Transaksi::where('id', $id)->update($jquin);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_outlet' => 'required',
            'id_member' => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');

        $number = Transaksi::count(); // ganti jadi menghitung data yang ada didatabase
        $date = date('ymd');
        if($number > 0 ) {
//            $number = Borrowing::max('invoice_id / kode_transaksi');
            $strnum = substr($number,3 ,3);
            $strnum = $number + 1;
            $date = date('ymd');

            if(strlen($strnum) == 3) {
                $kode = 'INV-'. $date . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'INV-' . $date . "0" . $strnum;
            } else if(strlen($strnum) == 1) {
                $kode = 'INV-' . $date . "00" . $strnum;
            }
        } else {
            $kode = 'INV-' . $date . "001";
        }


        // Insert tb_transaksi
        $transaksi = new Transaksi;
        $transaksi->id_outlet = $request->id_outlet;
        $transaksi->kode_invoice = $kode;
        $transaksi->id_member = $request->id_member;
        $transaksi->tgl = date('Y-m-d\TH:i:sP');
        $transaksi->status = 'baru';
        $transaksi->dibayar = 'belum_dibayar';
        $transaksi->id_user = Auth::user()->id;
        $transaksi->save();

        // Deklarasi var yang akan di parsing
        $idTransaksi = $transaksi->id;
        $idOutlet = $request->id_outlet;

        return redirect('tambah-paket/'.$idTransaksi.'/transaksi/'.$idOutlet.'');
    }

    public function tambahPaket($idTransaksi, $idOutlet)
    {
        $transaksi = Transaksi::where('id', $idTransaksi)->first();
        $outlet = Outlet::where('id', $idOutlet)->first();
        $id = DetailTransaksi::where('id_transaksi', $idTransaksi)->get();

        // Total Harga
        $harga = DB::table('detail_transaksi')
            ->join('paket', 'paket.id', '=', 'detail_transaksi.id_paket')
            ->select('detail_transaksi.id','paket.id', DB::raw('SUM(detail_transaksi.qty * paket.harga) as TotalHarga'))
            ->where('id_transaksi', $transaksi->id)
            ->get();

        return view('pages.admin.transaksi.tambah_paket', compact('transaksi', 'outlet', 'harga'));
    }

    public function paketStore(Request $request, $id)
    {
        $detailTransaksi = new DetailTransaksi;
        $detailTransaksi->id_transaksi = $id;
        $detailTransaksi->id_paket = $request->id_paket;
        $detailTransaksi->qty = $request->qty;
        $detailTransaksi->keterangan = $request->keterangan;
        $detailTransaksi->save();

        return $detailTransaksi;
    }

    public function updateTransaksi(Request $request, $id)
    {
        $cariKode = Transaksi::where('id', $id)->first();
        $kode_invoice = $cariKode->kode_invoice;

    	$jquin = [
    		'biaya_tambahan' => $request->biaya_tambahan,
    		'pajak' => $request->pajak,
            "batas_waktu" => $request->batas_waktu,
            "tgl_bayar" => $request->tgl_bayar,
    		'diskon' => $request->diskon,
    		'status' => $request->status,
    		'dibayar' => $request->dibayar,
    	];

    	$transaksi = Transaksi::where('id', $id)->update($jquin);

        Alert::success('Berhasil', 'Transaksi Sukses');
    	return redirect('/detail-transaksi/'.$kode_invoice.'/cucian');
    }

    public function detailView($kodeinvoice)
    {
        // Cari id_transaksi
        $jquin = Transaksi::where('kode_invoice', $kodeinvoice)->first();
        $idT = $jquin->id;
        $idO = $jquin->id_outlet;
        $pesanan = DetailTransaksi::where('id_transaksi', $idT)->get();

        // Total Harga
        $harga = DB::table('detail_transaksi')
            ->join('paket', 'paket.id', '=', 'detail_transaksi.id_paket')
            ->select('detail_transaksi.id','paket.id', DB::raw('SUM(detail_transaksi.qty * paket.harga) as TotalHarga'))
            ->where('id_transaksi', $idT)
            ->get();
        return view('pages.admin.transaksi.detail_transaksi', compact('jquin','pesanan','harga'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::destroy($id);

        Alert::success('Berhasil', 'Transaksi berhasil dihapus');
        return back();
    }

    public function destroyPaket($id)
    {
        DetailTransaksi::destroy($id);
    }


    // CARIAN
    // Dynamic Dropdown
    public function paket($id){
        $paket = DB::table('paket')
                  ->select('id','id_outlet','nama_paket')
                  ->where('id_outlet', $id)
                  ->groupBy('nama_paket')
                  ->get();

        return $paket;
      }

      public function jenis($id, $nama_paket)
      {
          $jenis = Paket::where('id_outlet', $id)->where('nama_paket', $nama_paket)->select('id','id_outlet','jenis', 'harga')->get();

          return $jenis;
      }

      public function harga($id)
      {
          $harga = Paket::where('id', $id)->select('id','id_outlet','jenis','harga','nama_paket')->get();

          return $harga;
      }

      // JSON Invoice
    public function detailTransaksi($id)
    {
        $transaksi = DB::table('detail_transaksi')
            ->join('paket', 'paket.id', '=', 'detail_transaksi.id_paket')
            ->select('detail_transaksi.id','paket.nama_paket','paket.jenis','detail_transaksi.qty','paket.harga','detail_transaksi.keterangan')
            ->where('id_transaksi', $id)
            ->get();

        return Datatables::of($transaksi)
        	->addColumn('harga', function($jquin)
            {
                return 'Rp. '.$jquin->harga;
            })
            ->addColumn('total', function($jquin)
            {
                return 'Rp. '.$jquin->harga * $jquin->qty;
            })
            ->addColumn('opsi', function($jquin)
            {
                return '<a href="#" onclick="destroy('. $jquin->id .');" title="Hapus Paket"; class="text-danger mr-1"><i class="fas fa-trash"></i></a>&nbsp;';
            })
            ->rawColumns(['opsi','harga'])
            ->addIndexColumn() // Tambah no ++
            ->removeColumn('id') // Hapus field
            ->toJson();
    }
}

