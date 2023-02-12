<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Laporan Transaksi Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="section-body">
        <div class="row">
            <div class="col-8">
              <div class="card">
                  <div class="card-body">

                    <table border="1">
                        <caption>Laporan Laundry</caption>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>No Telpon</th>
                                <th>Outlet</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->kode_invoice }}</td>
                                <td>{{ $laporan->member->nama }}</td>
                                <td>{{ $laporan->member->tlp }}</td>
                                <td>{{ $laporan->outlet->nama }}</td>
                                <td>{{ ucwords($laporan->status) }}</td>
                                <td>{{ $laporan->tanggal() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                  </div>
              </div>
            </div>
          </div>
      </div>
</body>
</html>
