@extends('layouts.master')
@section('title', 'Data Pengguna')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Pengguna</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                  <div class="card-body">
                                          <!-- card-header -->
                    <div class="card-header px-0">
                        <div class="row">
                            <div class="col-md-12 col-lg-7 col-xl-4 mb-50">
                                <span class="invoice-id font-weight-bold">Invoice# </span>
                                <span>{{ $jquin->kode_invoice }}</span>
                            </div>
                            <div class="col-md-12 col-lg-5 col-xl-8">
                                <div class="d-flex align-items-center justify-content-end justify-content-xs-start">
                                    <div class="issue-date pr-2">
                                        <span class="font-weight-bold no-wrap">Tanggal Masuk: </span>
                                        <span>{{ date('d/m/Y', strtotime($jquin->tgl)) }}</span>
                                    </div>
                                    <div class="due-date">
                                        <span class="font-weight-bold no-wrap">Batas Waktu Pengambilan: </span>
                                        <span>{{ date('d/m/Y', strtotime($jquin->batas_waktu)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- invoice address and contacts -->
                    <div class="row invoice-adress-info py-2">
                        <div class="col-6 mt-1 from-info">
                            <div class="info-title mb-1">
                                <span>Outlet</span>
                            </div>
                            <div class="company-name mb-1">
                                <span class="text-muted">{{ $jquin->outlet->nama }}</span>
                            </div>
                            <div class="company-address mb-1">
                                <span class="text-muted">{{ $jquin->outlet->alamat }}</span>
                            </div>
                            <div class="company-phone  mb-1">
                                <span class="text-muted">{{ $jquin->outlet->tlp }}</span>
                            </div>
                            <div class="company-kasir  mb-1 mb-1">
                                <span class="text-muted">Kasir - {{ $jquin->user->nama }}</span>
                            </div>
                            <div class="company-status  mb-1 mb-1">
                                <span class="text-muted">Status Pesanan - {{ ucwords($jquin->status) }}</span>
                            </div>
                            <div class="company-dibayar  mb-1 mb-1">
                                <span class="text-muted">Status Pembayaran -
                                    @if($jquin->dibayar == 'belum_dibayar')
                                        Belum Dibayar
                                    @else
                                        Dibayar
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-6 mt-1 to-info">
                            <div class="info-title mb-1">
                                <span>Pelanggan</span>
                            </div>
                            <div class="company-name mb-1">
                                <span class="text-muted">{{ $jquin->member->nama }}</span>
                            </div>
                            <div class="company-address mb-1">
                                <span class="text-muted">{{ $jquin->member->alamat }}</span>
                            </div>
                            <div class="company-phone  mb-1">
                                <span class="text-muted">{{ $jquin->member->tlp }}</span>
                            </div>
                        </div>
                    </div>

                    <!--product details table -->
                    <div class="product-details-table py-2 table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis Cucian</th>
                                    <th scope="col">Paket</th>
                                    <th scope="col">Jumlah Cucian</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanan as $detail)
                                <tr>
                                    <td>{{ $detail->paket->jenis }}</td>
                                    <td>{{ $detail->paket->nama_paket }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ number_format($detail->paket->harga, 2) }}/Cucian</td>
                                    <td>{{ $detail->keterangan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><b><i>Tidak Ada Data</i></b></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <!-- invoice total -->
                    <div class="invoice-total py-2">
                        <div class="row">
                            <div class="col-4 col-sm-6 mt-75">
                            </div>
                            <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                <ul class="list-group cost-list">
                                   <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                        <span class="cost-title mr-2">Subtotal </span>
                                        <span class="cost-value">Rp.
                                        	@foreach($harga as $subtotal)
                                        		{{ number_format($subtotal->TotalHarga, 2) }}
                                        	@php
                                        		$sTotal = $subtotal->TotalHarga;
                                        	@endphp
                                        	@endforeach
                                        </span>
                                    </li>
                                    <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                        <span class="cost-title mr-2">Biaya Tambahan </span>
                                        <span class="cost-value">Rp. {{ number_format($jquin->biaya_tambahan, 2) }}</span>
                                    </li>
                                    <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                        <span class="cost-title mr-2">Pajak </span>
                                        <span class="cost-value">Rp. {{ number_format($jquin->pajak, 2) }}</span>
                                    </li>
                                    <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                        <span class="cost-title mr-2">Diskon </span>
                                        @if($jquin->diskon == '')
                                        <span class="cost-value">0%</span>
                                        @else
                                        <span class="cost-value">{{ $jquin->diskon }}%</span>
                                        @endif
                                    </li>
                                     @php
                                        $keseluruhanInvoice = $sTotal+$jquin->biaya_tambahan+$jquin->pajak;
                                        $diskon = $jquin->diskon;
                                        $totalDiskon = ($diskon/100)*$keseluruhanInvoice;
                                        $totalBayar = $keseluruhanInvoice-$totalDiskon;

                                        $total = number_format($totalBayar,2,',','.');
                                    @endphp
                                    <li class="dropdown-divider"></li>
                                    <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                        <span class="cost-title mr-2">Total</span>
                                        <span class="cost-value">Rp. {{ $total }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-icon icon-left" type="button" onclick="printPdf();"><i class="fas fa-print"></i> Print</button>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>

@endsection

@push('addon-script')
    <!-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $('#penggunaTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(id){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data Pelanggan?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.value) {
                            $('#delete'+id).submit();
                        }
                    })
        }

        function printPdf() {
            window.print();
            // alert("netnod");
        }
    </script>
@endpush
