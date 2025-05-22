@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"></h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow rounded-4">
                <div class="card-body">
                    <h5 class="card-title">Total Tugas</h5>
                    <p class="display-6">{{ $totalTugas }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow rounded-4">
                <div class="card-body">
                    <h5 class="card-title">Selesai</h5>
                    <p class="display-6">{{ $selesai }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow rounded-4">
                <div class="card-body">
                    <h5 class="card-title">Sedang Dikerjakan</h5>
                    <p class="display-6">{{ $sedang }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-secondary shadow rounded-4">
                <div class="card-body">
                    <h5 class="card-title">Menunggu</h5>
                    <p class="display-6">{{ $menunggu }}</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <h4>5 Tugas Terbaru</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark text-white">
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Batas Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugasTerbaru as $tugas)
                <tr>
                    <td>{{ $tugas->judul }}</td>
                    <td>{{ Str::limit($tugas->deskripsi, 50) }}</td>
                    <td>
                        <span class="badge bg-{{ $tugas->status == 'Selesai' ? 'success' :
                        ($tugas->status == 'Sedang Dikerjakan' ? 'warning'
                        :($tugas->status == 'Menunggu' ? 'secondary' : 'dark')) }}">
                            {{ $tugas->status }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d-m-Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada tugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

