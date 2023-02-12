@extends('layouts.master')
@section('title', 'Data Transaksi')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Transaksi</h1>
      </div>

      <div class="section-body">
        <div class="row gx-2">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah Paket</h6>
                        <div class="mx-auto">
                            <h6>{{ $transaksi->kode_invoice }}</h6>
                          </div>
                    </div>
                    <div class="card-body p-0">
                    <div class="table-responsive px-3">
                        <form class="form row" id="tambahPaket">
                            @csrf
                            {{ method_field('POST') }}
                            <div class="form-group col-3">
                                <label for="paket">Paket</label>
                                <select class="form-control" name="nama_paket" id="paket" class="nama_paket" required>
                                    <option disabled selected>-- Pilih Paket --</option>
                                </select>
                                <input type="hidden" name="id_paket" id="id_paket"  required>
                            </div>

                            <div class="form-group col-3">
                                <label for="jenis">Jenis Cucian</label>
                                <select class="form-control" id="jenis">
                                    <option>-- Pilih Cucian --</option>
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="jmlCucian" class="cursor-pointer">Jumlah Cucian</label>
                                <input type="number" class="form-control" name="qty" id="jmlCucian" placeholder="1" required>
                            </div>

                            <div class="form-group col-3">
                                <label for="harga">Harga</label>
                                <p class="form-control-static" id="harga">Rp. 0</p>
                            </div>

                            <!-- <div class="form-group col-sm-12 col-md-2">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="2" class="form-control"></textarea>
                            </div> -->

                            <div class="form-group col">
                                <button type="submit" class="btn btn-primary mt-2">
                                    <i class="fa fa-plus"></i> Tambahkan
                                </button>
                            </div>
                            </form>
                    </div>
                    </div>
                    <hr>
                    <div class="card-body p-3">
                        <!-- Table -->
                    <div class="row">
                        <div class="col-12">
                            <div id="tambahPaket" class="table-responsive position-relative">
                            <table class="table" id="detail-transaksi"style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paket</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                    <th>Opsi</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="card-body p-0">
                    <div class="table-responsive px-3">
                        <form action="{{ route('uTransaksi', $transaksi->id) }}" class="form row" method="post" >
                            @csrf
                            {{ method_field('POST') }}
                            <div class="form-group col-4">
                                <label for="biaya_tambahan">Biaya Tambahan</label>
                                <input type="text" name="biaya_tambahan" id="biaya_tambahan" class="form-control">
                            </div>

                            <div class="form-group col-4">
                                <label for="pajak">Pajak</label>
                                <input type="text" name="pajak" id="pajak" class="form-control">
                            </div>

                            <div class="form-group col-4">
                                <label for="diskon">Diskon</label>
                                <input type="number" name="diskon" id="diskon" class="form-control" max="100">
                            </div>
                            <div class="form-group col-6">
                                <label for="status">Status Pesanan</label>
                                <select class="custom-select block" name="status" id="status" required >
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="diambil">Diambil</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="dibayar">Status Pembayaran</label>
                                <select class="custom-select block" name="dibayar" id="dibayar" required >
                                    <option value="dibayar">Dibayar</option>
                                    <option value="belum_dibayar">Belum dibayar</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="status">Tanggal Bayar</label>
                                <input type="date" class="form-control" name="tgl_bayar" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="status">Batas Waktu Pengambilan</label>
                                <input type="date" class="form-control" name="batas_waktu" required>
                            </div>

                            <div class="form-group col">
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Detail</h6>
                    </div>
                  <div class="card-body p-3">
                    <div class="form-group form-inline">
                        <label class="col-sm-3  control-label">Nama Pelanggan</label>
                        <div class="col-sm-9">
                        <input readonly="" type="text" class="form-control"  value="{{ $transaksi->member->nama }}" >
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-sm-3  control-label">Tanggal</label>
                        <div class="col-sm-9">
                        <input readonly="" type="text" class="form-control"  value="{{ $transaksi->tgl }}" >
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-sm-3  control-label">Outlet</label>
                        <div class="col-sm-9">
                        <input readonly="" type="text" class="form-control"  value="{{ $transaksi->outlet->nama }}" >
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-sm-3  control-label">Kasir</label>
                        <div class="col-sm-9">
                        <input readonly="" type="text" class="form-control"  value="{{ $transaksi->user->nama }}" >
                        </div>
                    </div>
                    <hr>
                    <div class="info" style="margin-top:15px;">
                        <h6>Total</h6>
                        <h2>Rp. <span class="badge badge-info rounded-0 float-right" id="totalHarga">
                        @foreach($harga as $subtotal)
                            {{ number_format($subtotal->TotalHarga, 2) }}
                        @php
                            $sTotal = $subtotal->TotalHarga;
                        @endphp
                        @endforeach
                        </span></h2>
                    </div>
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
            $('#penggunaTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        jQuery(function () {
         // Cari Paket
         var outlet_id = "{{ $transaksi->id_outlet }}";
         console.log(outlet_id);

         $.get('/json/cari-paket/' + outlet_id,function(data) {
           $('#paket').empty();
           $('#paket').append('<option value="0" disable="true" selected="true">-- Pilih Paket --</option>');

         $.each(data, function(index, paketObj){
             $('#paket').append('<option value="'+ paketObj.nama_paket +'">'+ paketObj.nama_paket +'</option>');
           })
         });

         // Cari Jenis Paket
         $('#paket').on('change', function(e){
            var idPaket = "{{ $transaksi->id_outlet }}";
            var namaPaket = e.target.value;

            $.get('/json/cari-jenis/'+ idPaket +'/'+ namaPaket,function(data) {
              $('#jenis').empty();
              $('#jenis').append('<option value="0" disable="true" selected="true">-- Pilih Cucian --</option>');

              $.each(data, function(index, jenisObj){
                $('#jenis').append('<option value="'+ jenisObj.id +'">'+ jenisObj.jenis +'</option>');
              })
            });
          });

         // Cari Harga
         $('#jenis').on('change', function(e){
            console.log(e);
            var harga = e.target.value;

            $.get('/json/cari-harga/'+ harga,function(data) {
              $('#harga').empty();

              $.each(data, function(index, harga){
                $('#harga').append('<span> Rp. '+ harga.harga + '/' + harga.jenis +'</span>');
              })
              $('#id_paket').val(data[0]['id']);
            });
          });
    });

  		// Data Table
        var table = $('#detail-transaksi').DataTable({
              processing: true,
              serverSide: true,
              ajax: "/json/cari-paket/{{$transaksi->id}}/detail-transaksi",
              columns: [
                  {data: 'DT_RowIndex', name:'DT_RowIndex'},
                  {data: 'nama_paket', name: 'nama_paket'},
                  {data: 'jenis', name: 'jenis'},
                  {data: 'qty', name: 'qty'},
                  {data: 'harga', name: 'harga'},
                  {data: 'total', name: 'total'},
                  {data: 'keterangan', name: 'keterangan'},
                  {data: 'opsi', name: 'opsi', orderable: false, searchable: false}
              ],
              "columnDefs": [
                  { "width": "5%", "targets": 0 }
               ]
          });

        /////////////////
        // Tambah Data //
        /////////////////
        $(function () {
             $('#tambahPaket').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    // Ajax
                    $.ajax({
                        url: "/tambah-paket/{{$transaksi->id}}/detail-transaksi",
                        type: "POST",
                        data: $("#tambahPaket").serialize(),
                        success: function($data) {
                            table.ajax.reload();

                            $("#totalHarga").load(window.location + " #totalHarga");
                            toastr.success('Paket Berhasil Ditambahkan','Sukses');
                            $('#jmlCucian').val('');
                            $('#keterangan').val('');
                        },
                        error: function () {
                            Swal.fire(
                              'Opps!',
                              'Terjadi Error...!',
                              'error',
                              '1500'
                            )
                        }
                    });
                    return false;
                }
            });
        });

  		/////////////////
        // Hapus Paket  //
        /////////////////
        function destroy(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
              title: 'Hapus!',
              text: "Paket Ini?",
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonColor: '#00B5B8',
              confirmButtonText: 'Oke',
              reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('dPaket') }}" + '/' + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function (data) {
                            $("#totalHarga").load(window.location + " #totalHarga");
                            table.ajax.reload();
                            toastr.success('Paket Berhasil Dihapus','Sukses');
                        },
                        error: function () {
                            Swal.fire(
                              'Opps!',
                              'Terjadi Error...!',
                              'error',
                              '1500'
                            )
                        }
                    })
                }
            })
        }

        // Invoice
        $('#biaya_tambahan').keyup(function() {
        	var biayaTambahan = $('#biaya_tambahan').val();
            $('#biayaVal').text('Rp. '+ biayaTambahan +'');
        });

        $('#pajak').keyup(function() {
        	var pajak = $('#pajak').val();
            $('#pajakVal').text('Rp. '+ pajak +'');
        });

        $('#diskon').keyup(function() {
        	var diskon = $('#diskon').val();
            $('#diskonVal').text(''+ diskon +'%');
        });
    </script>
@endpush
