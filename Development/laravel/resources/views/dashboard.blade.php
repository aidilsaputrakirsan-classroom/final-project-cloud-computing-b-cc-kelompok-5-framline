@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Selamat Datang di Dashboard</h1>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text fs-3">120</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Penjualan Bulan Ini</h5>
                        <p class="card-text fs-3">Rp 45.000.000</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Produk Terjual</h5>
                        <p class="card-text fs-3">340</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Pending</h5>
                        <p class="card-text fs-3">12</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <strong>Data Penjualan Terbaru</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kopi Arabica</td>
                            <td>5</td>
                            <td>2025-11-01</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Teh Hijau</td>
                            <td>3</td>
                            <td>2025-10-31</td>
                            <td><span class="badge bg-warning">Proses</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Gula Aren</td>
                            <td>2</td>
                            <td>2025-10-30</td>
                            <td><span class="badge bg-danger">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
