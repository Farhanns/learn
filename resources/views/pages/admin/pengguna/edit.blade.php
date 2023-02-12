@extends('layouts.master')
@section('title', 'Data Pengguna')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Data Pengguna</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header">
                  <a href="{{ route('data-pengguna.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('data-pengguna.update', $pengguna->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- <div class="card-header">
                          <h4>Isi Data Berikut</h4>
                        </div> -->
                       <div class="card-body">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $pengguna->nama }}" required>
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ $pengguna->username }}" required>
                          </div>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password"class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                          </div>
                          <div class="form-group">
                            <label>Role</label>
                            <select name="role" id="" class="custom-select" required>
                                <option value="{{ $pengguna->role }}" selected disabled>=== {{ ucfirst($pengguna->role) }} ===</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="owner">Owner</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Outlet</label>
                            <select name="id_outlet" id="" class="custom-select" required>
                                <option value="{{ $pengguna->id_outlet }}" selected disabled>=== {{ $pengguna->outlet->nama }} ===</option>
                                @foreach($outlet as $ot)
                                <option value="{{ $ot->id }}">{{ $ot->nama }}</option>
                                @endforeach
                            </select>
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
