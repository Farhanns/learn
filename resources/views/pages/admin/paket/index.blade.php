@extends('layouts.master')
@section('title', 'Data Paket')

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data Paket</h1>
      </div>

      <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <h5>Data Outlet</h5>
                  <!-- <a href="{{ route('data-paket.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Paket</a> -->
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
                    <table id="paketTable" class="table table-striped" >
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Outlet</th>
                              <th>Alamat</th>
                              <th>No Telpon</th>
                              <th>Jumlah Paket</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($outlet as $i => $ot)
                            <tr>
                                <td>{{ $i += 1 }}</td>
                                <td>{{ $ot->nama }}</td>
                                <td>{{ $ot->alamat }}</td>
                                <td>{{ $ot->tlp }}</td>
                                <td>{{ $ot->jumlah }}</td>
                                <td>
                                    <a href="{{ route('data-paket.show', $ot->id) }}" class="btn btn-info">Detail</a>
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
            $('#paketTable').DataTable();
        } );
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         function deleteData(id){
            Swal.fire({
                    title: 'PERINGATAN!',
                    text: "Yakin ingin menghapus data Outlet?",
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
