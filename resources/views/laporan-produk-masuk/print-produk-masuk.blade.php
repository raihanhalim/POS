<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Produk Masuk</title>
    <style>
        .container {
            text-align: center;
            margin: auto;
        }

        .column {
            text-align: center;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            margin: auto;
            width: 100%;
        }

        tr {
            text-align: left;
        }

        table, th, td {
            border-collapse: collapse;
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
        }

        th{
            background-color: gainsboro;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column">
                <h2>Cafe Jingga</h2>
                <p>Jl. Mangekyo, Desa Sharingan Rt.01, Rw.02, Kecamatan Uchiha <br> Kabupaten Otsutsuki, Jawa</p>
                <hr style="width: 85%; text-align: center;">
                <h3 style="text-align: center;">Laporan produk Masuk {{ 
                    ($tanggalMulai && $tanggalSelesai) ? 
                    date('d-m-Y', strtotime($tanggalMulai)) . ' - ' . date('d-m-Y', strtotime($tanggalSelesai)) : 
                    'Semua Range Tanggal' 
                }}
                </h3>
            </div>
            <div class="col">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Produk</th>
                            <th>Stok Masuk</th>
                            <th>Harga Per-tem</th>
                            <th>Total Harga</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalHarga = 0; ?>
                        @foreach ($data as $produk)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: center">{{ date('d-m-Y', strtotime($produk->tgl_masuk)) }}</td>
                                <td>{{ $produk->kd_transaksi }}</td>
                                <td>{{ $produk->nm_produk }}</td>
                                <td style="text-align: center">{{ $produk->stok_masuk }}</td>
                                <td>Rp. {{ number_format( $produk->harga_beli, 2, ',', '.' ) }}</td>
                                <td>Rp. {{ number_format( $produk->total_harga, 2, ',', '.') }}</td>
                                <td>{{ $produk->supplier->supplier }}</td>
                            </tr>  
                            <?php $totalHarga += $produk->total_harga; ?>
                        @endforeach                     
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8"><strong>Total Biaya Pembelian : Rp. {{ number_format($totalHarga, 2, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
