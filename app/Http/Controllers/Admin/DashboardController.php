<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.admin.dashboard', [
            'trx' => Transaksi::count(),
            'outlet' => Outlet::count(),
            'member' => Member::count(),
            'pengguna' => User::count(),
        ]);
    }
}
