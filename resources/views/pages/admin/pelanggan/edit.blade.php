@extends('layouts.master')
@section('title', 'Data Pelanggan')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Pelanggan</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-pelanggan.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-pelanggan.update', $pelanggan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                       <div class="card-body">
                          <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $pelanggan->nama }}" required>
                          </div>
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="custom-select">
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required>{{ $pelanggan->alamat }}</textarea>
                          </div>
                          <div class="form-group">
                            <label>No Telpon</label>
                            <input type="text"class="form-control @error('tlp') is-invalid @enderror" name="tlp" id="tlp" value="{{ $pelanggan->tlp }}" required>
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
