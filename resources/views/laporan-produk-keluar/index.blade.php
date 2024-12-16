@extends('layouts.app')

@section('content')

<style>
    .text-on-left {
        text-align: left !important;
        float: left !important;
        width: 100% !important;
    }
</style>

<div class="section-header">
    <h1>Laporan Produk Keluar</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-danger" id="print-laporan-produk-keluar"><i class="fa fa-sharp fa-light fa-print"></i> Print PDF</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="form-group">
                    <form id="filter_form" action="/laporan-produk-keluar/get-data" method="GET">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <label>Pilih Tanggal Mulai :</label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                            </div>
                            <div class="col-md-5 my-2">
                                <label>Pilih Tanggal Selesai :</label>
                                <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai">
                            </div>
                            <div class="col-md-2 d-flex align-items-end my-2">
                                <button type="submit" class="btn btn-primary mx-2">Filter</button>
                                <button type="button" class="btn btn-danger" id="refresh_btn">Refresh</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Keluar</th>
                                <th>Kode Transaksi</th>
                                <th>Nama Produk</th>
                                <th>Stok Keluar</th>
                                <th>Harga Per-tem</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Datatables Jquery -->
<script>
    $(document).ready(function () {
        let table = $('#table_id').DataTable();

        loadData();

        $('#filter_form').submit(function (event) {
            event.preventDefault();
            loadData();
        });

        $('#refresh_btn').on('click', function () { 
            refreshTable();
        });


        function loadData() {
            var tanggalMulai    = $('#tanggal_mulai').val();
            var tanggalSelesai  = $('#tanggal_selesai').val();

            $.ajax({
                url: '/laporan-produk-keluar/get-data',
                type: "GET",
                dataType: 'JSON',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_selesai: tanggalSelesai
                },
                success: function (response) {
                    let counter = 1;
                    table.clear().draw();

                    if(response.length === 0){
                        $('#table_id tbody');
                        $('#print-laporan-produk-keluar').addClass('disabled');
                    } else {
                        $.each(response, function (key, value) {
                            let formattedHargaBeli  = parseFloat(value.harga_beli).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                            let produkKeluar = `
                                <tr class="barang-row" id="index_${value.id}">
                                    <td>${counter++}</td>
                                    <td>${value.tgl_keluar}</td>
                                    <td>${value.kd_transaksi}</td>
                                    <td>${value.nm_produk}</td>
                                    <td>${value.stok_keluar}</td>
                                    <td>${formattedHargaBeli}</td>
                                    <td>${value.deskripsi}</td>
                                </tr>
                            `;
                            table.row.add($(produkKeluar)).draw(false);
                        });
                    }
                }
            });
        }

        function refreshTable(){
            $('#filter_form')[0].reset();
            loadData();
        }

        $('#print-laporan-produk-keluar').on('click', function(){
            var tanggalMulai    = $('#tanggal_mulai').val();
            var tanggalSelesai  = $('#tanggal_selesai').val();

            var url = '/laporan-produk-keluar/print-produk-keluar';

            if(tanggalMulai && tanggalSelesai){
                url += '?tanggal_mulai=' + tanggalMulai + '&tanggal_selesai=' + tanggalSelesai;
            }

            window.location.href = url;
        });
    });
</script>





@endsection