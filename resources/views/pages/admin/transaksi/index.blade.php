@extends('layouts.master')
@section('title', 'Data Transaksi')

@section('content')
<div class="modal fade text-left" id="form-status" tabindex="-1" role="dialog" aria-labelledby="form-status-transaksi" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title" id="form-status-transaksi">Edit Status Pesanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST">
          @csrf
          {{ method_field('PATCH') }}
            <div class="modal-body">
              <input type="hidden" id="id" name="id">
              <div class="row">
                <div class="col-12">
                  <label for="status_pesanan">Status Pesanan</label>
                   <select class="form-control" name="status_pesanan" id="status_pesanan" style="width: 100%;">
                      <option value="baru">Baru</option>
                      <option value="proses">Proses</option>
                      <option value="selesai">Selesai</option>
                      <option value="diambil">Diambil</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </div>
          </form>
      </div>
    </div>
  </div>
<div class="modal fade" tabindex="-1" role="dialog" id="trx">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Transaksi Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('transaksi.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-6">
                    <label for="outlet">Outlet</label>
                    <input type="text" name="id_outlet" id="" class="form-control" value="{{ Auth::user()->outlet->id }}" readonly>
                </div>

                <div class="form-group col-6">
                   <label for="pelanggan">Pelanggan</label>
                   <select class="custom-select" id="pelanggan" name="id_member">
                       <option value="" selected disabled>Pilih Pelanggan</option>
                       @forelse($member as $mbr)
                       <option value="{{ $mbr->id }}">{{ $mbr->nama }}</option>
                        @empty
                        <option disabled="">-- Tidak Ada Pelanggan --</option>
                        @endforelse
                    </select>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Transaksi</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <!-- <a href="{{ route('data-pengguna.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a> -->
                  <button class="btn btn-primary" id="modal-1" data-toggle="modal" data-target="#trx"><i class="fas fa-plus"></i> Tambah Transaksi</button>
                  <!-- <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div> -->
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive px-3">
                    <table id="penggunaTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Invoice</th>
                              <th>Nama Pelanggan</th>
                              <th>Tanggal</th>
                              <th>Outlet</th>
                              <th>Kasir</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($transaksi as $i => $trx)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <td>{{ $trx->kode_invoice }}</td>
                                <td>{{ $trx->member->nama }}</td>
                                <td>{{ $trx->tgl }}</td>
                                <td>{{ $trx->outlet->nama }}</td>
                                <td>{{ $trx->user->nama }}</td>
                                <td>
                                    @if($trx->status == 'baru')
                                    <a href="#" onclick="status('{{ $trx->id }}');"><span class="badge badge-info">{{ ucfirst($trx->status) }}</span></a>
                                    @elseif($trx->status == 'proses')
                                    <a href="#" onclick="status('{{ $trx->id }}');"><span class="badge badge-warning">{{ ucfirst($trx->status) }}</span></a>
                                    @elseif($trx->status == 'selesai')
                                    <a href="#" onclick="status('{{ $trx->id }}');"><span class="badge badge-success">{{ ucfirst($trx->status) }}</span></a>
                                    @elseif($trx->status == 'diambil')
                                    <a href="#" onclick="status('{{ $trx->id }}');"><span class="badge badge-primary">{{ ucfirst($trx->status) }}</span></a>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ url('/detail-transaksi/'.$trx->kode_invoice.'/cucian') }}" class="btn btn-info">Detail</a>
                                   <form action="{{ url('transaksi', $trx->id) }}" class="d-inline" id="delete{{ $trx->id }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="deleteData({{ $trx->id }})">Hapus</button>
                                   </form>
                                </td>
                            </tr>

                          @endforeach
                      </tbody>
                    </table>
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

        // Custom Select Option
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(document).ready(function() {
        // Hide
        $('#hideElmen').hide();

        // Show
        $('#pelanggan').on('change', function (e) {
            var idPelanggan = e.target.value;

            $.get('/json/'+idPelanggan+'/cari-pelanggan', function (data) {
                $('#hideElmen').show();
                $('#tlp_pelanggan').val(data.tlp);
                $('#alamat_pelanggan').val(data.alamat);
            })
        })
      });

      function status(id) {
            $('input[name=_method]').val('PATCH');
            $('#form-status').modal('show');
            $('#form-status form')[0].reset();

            $.ajax({
                url: "/json/"+id+"/status",
                type: "GET",
                dataType: "JSON",
                success: function (jquin) {
                    $('#id').val(jquin.id);
                    $('#status_pesanan').val(jquin.status);
                },
                error : function () {
                    Swal.fire(
                      'Opps!',
                      'Terjadi Error...!',
                      'error',
                      '1500'
                    )
                }
            });
        }

        $(function () {
             $('#form-status form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                url = "/status/"+id+"/update";

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#form-status form").serialize(),
                        success: function($data) {
                            $("#form-status").modal('hide');
                            $("#penggunaTable").load(window.location + " #penggunaTable");
                            toastr.success('Status Berhasil Diperbharui','Sukses');
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
    </script>

    <!-- TRANSAKSI -->

@endpush
