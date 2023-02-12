@extends('layouts.master')
@section('title', 'Data Outlet')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Outlet</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-outlet.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-paket.update', $paket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                       <div class="card-body">
                          <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" name="nama_paket" id="nama_paket" value="{{ $paket->nama_paket }}" required>
                          </div>
                          <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" id="" class="custom-select">
                                <option value="kiloan">Kiloan</option>
                                <option value="selimut">Selimut</option>
                                <option value="bed_cover">Bed Cover</option>
                                <option value="kaos">Kaos</option>
                                <option value="lain">Lain-lain</option>
                            </select>
                            </div>
                          <div class="form-group">
                            <label>Harga</label>
                            <input type="text"class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ $paket->harga }}" required>
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>

@endsection

@push('addon-script')

@endpush
