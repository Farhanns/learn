@extends('layouts.master')
@section('title', 'Laporan')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Laporan</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                      <h5>Filter Data</h5>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ url('getlaporan') }}" method="POST">
                            @csrf
                            <div class="form-group px-3">
                                <label>Outlet</label>
                                <select name="outlet" class="custom-select @error('outlet') is-invalid @enderror" {{ count($outlet) == 0 ? 'disabled' : '' }}>
                                    @if(count($outlet) == 0)
                                       <option>Pilihan tidak ada</option>
                                    @else
                                       <option value="">Silahkan Pilih</option>
                                          @foreach($outlet as $c)
                                             <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                          @endforeach
                                    @endif
                                </select>
                              </div>
                              <div class="form-group px-3">
                                <label>status</label>
                                <select name="status" class="custom-select @error('status') is-invalid @enderror">
                                    <option value="">Silahkan Pilih</option>
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="diambil">Diambil</option>
                                </select>
                              </div>
                              <hr style="border-color: #f9f9f9 !important;">
                              <div class="form-group px-3">
                                  <label for="">Rentang Tanggal</label>
                                <input type="text" name="date_from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $from ?? '' }}">
                                </div>
                                <div class="form-group px-3">
                                    <input type="text" name="date_to" class="form-control" placeholder="Tanggal Akhir"
                                        onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $to ?? '' }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                </div>
                                <p class="text-muted px-2">*Jika ingin mengeksport semua data abaikan form diatas, dan langsung klik cari data.</p>
                        </form>
                    </div>
                  </div>
            </div>
            <div class="col-8">
                <div class="card">
                   <div class="row">
                       <div class="col">
                        <div class="card-header">
                            <h5>Hasil Filter</h5>
                          </div>
                       </div>
                       <div class="col">
                        <div class="float-right pt-3 pr-3">
                        @if ($transaksi ?? '')
                          <form action="{{ url('laporan/export') }}" method="POST">
                              @csrf
                              <input type="hidden" name="outlet" value="{{ $outlets }}">
                              <input type="hidden" name="status" value="{{ $status }}">
                              <input type="hidden" name="date_from" value="{{ $from }}">
                              <input type="hidden" name="date_to" value="{{ $to }}">
                              <button type="submit" class="btn btn-info">EXPORT PDF</button>
                          </form>
                          @endif
                      </div>
                    </div>
                   </div>
                    <div class="card-body p-0">
                        <div class="table-responsive p-3">
                            @if ($transaksi ?? '')
                        <table class="table" id="transaksiTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No Telpon</th>
                                    <th>Outlet</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $k => $v)
                                <tr>
                                    <td>{{ $k += 1 }}</td>
                                    <td>{{ $v->kode_invoice }}</td>
                                    <td>{{ $v->member->nama }}</td>
                                    <td>{{ $v->member->tlp }}</td>
                                    <td>{{ $v->outlet->nama }}</td>
                                    <td>{{ $v->tgl }}</td>
                                    <td>
                                        @if($v->status == 'baru')
                                        <span class="badge badge-info">{{ ucfirst($v->status) }}</span>
                                        @elseif($v->status == 'proses')
                                        <span class="badge badge-warning">{{ ucfirst($v->status) }}</span>
                                        @elseif($v->status == 'selesai')
                                        <span class="badge badge-success">{{ ucfirst($v->status) }}</span>
                                        @elseif($v->status == 'diambil')
                                        <span class="badge badge-primary">{{ ucfirst($v->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            Tidak ada data
                        </div>
                        @endif
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
    @if ($transaksi ?? '')
        @if ($outlets != null)
        <script>
            $(document).ready(function() {
                $('#{{ $outlets }}').prop('checked', true);
            });
        </script>
        @endif
    @endif
    <script>
         $(document).ready(function() {
        $('#transaksiTable').DataTable();
    } );
    </script>
@endpush
