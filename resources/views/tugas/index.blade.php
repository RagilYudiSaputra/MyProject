@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Tugas</h2>

    {{-- Filter Form --}}
    <form method="GET" class="row g-2 align-items-end mb-3">
        <div class="col-md-3">
            <input type="date" name="batas_waktu" class="form-control" value="{{ request('batas_waktu') }}">
        </div>
        <div class="col-md-3">
            <select name="prioritas" class="form-select">
                <option value="">-- Semua Prioritas --</option>
                <option value="Tinggi" {{ request('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                <option value="Sedang" {{ request('prioritas') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Rendah" {{ request('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari tugas..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
            <a href="{{ route('tugas.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    {{-- Tabel Tugas --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th> {{-- Kolom Deskripsi --}}
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Batas Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ Str::limit($item->deskripsi, 100) }}</td> {{-- Menampilkan deskripsi singkat --}}
                    <td>
                        <span class="badge bg-{{ $item->prioritas == 'Tinggi' ? 'danger' : ($item->prioritas == 'Sedang' ? 'warning' : 'secondary') }}">
                            {{ $item->prioritas }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'Selesai' ? 'success' : ($item->status == 'Sedang Dikerjakan' ? 'warning' : ($item->status == 'Menunggu' ? 'secondary' : 'dark')) }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->batas_waktu)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tugas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada tugas ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    <div class="mt-3">
        {{ $tugas->withQueryString()->links() }}
    </div>
</div>
@endsection
