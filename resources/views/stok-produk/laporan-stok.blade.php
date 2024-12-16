<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Stok</title>
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
            width: 80%;
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
                <h3 style="text-align: center;">Laporan Stok Berdasarkan : {{ $selectedOption }}</h3>
            </div>
            <div class="col">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $produk->kd_produk }}</td>
                                <td>{{ $produk->nm_produk }}</td>
                                <td style="text-align: center">{{ $produk->stok }}</td>
                            </tr>  
                        @endforeach                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>