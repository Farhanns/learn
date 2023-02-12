@extends('layouts.master')
@section('title', 'Dashboard')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="" class="text-decoration-none">{{ now()->format('l, d F Y') }}</a></div>
          </div>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaksi</h4>
                  </div>
                  <div class="card-body">
                    {{ $trx }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pelanggan</h4>
                  </div>
                  <div class="card-body">
                    {{ $member }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Outlet</h4>
                  </div>
                  <div class="card-body">
                    {{ $outlet }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-layer-group"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengguna</h4>
                  </div>
                  <div class="card-body">
                    {{ $pengguna }}
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                      <h4>Selamat Datang, {{ Auth::user()->nama }}!</h4>
                    </div>
                    <form action="" method="GET">
                        <div class="card-body">
                            <p>Klik tombol dibawah ini untuk menambahkan transaksi baru.</p>
                            <a href="{{ url('transaksi') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a>
                        </div>
                      </form>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Histori Pembayaran</h4>
                        <div class="card-header-action">
                          <a href="" class="btn btn-primary">
                            Lihat Semua
                          </a>
                        </div>
                      </div>
                        <div class="card-body">
                            <div class="table-responsive p-3">

                              </div>
                        </div>
                  </div>
            </div>
        </div>
      </div>
    </section>
  </div>

@endsection

@push('addon-script')
<script>
    $(document).ready(function() {
        $('#siswaTable').DataTable();
    } );
</script>
@endpush
