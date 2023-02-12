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
                <div class="card-header">
                  <a href="{{ route('data-pengguna.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pengguna</a>
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
                              <th>Nama</th>
                              <th>Username</th>
                              <th>Role</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($pengguna as $i => $user)
                            <tr>
                                <td>{{ $i += 1 . "." }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <a href="{{ route('data-pengguna.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                   <form action="{{ url('data-pengguna', $user->id) }}" class="d-inline" id="delete{{ $user->id }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="deleteData({{ $user->id }})">Hapus</button>
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
    </script>
@endpush
