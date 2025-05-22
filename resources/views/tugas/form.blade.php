@extends('layouts.app')

@section('title', isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">{{ isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas' }}</h2>

    <div class="row">
        <div class="col-12 col-xl-12" style="padding-right: 25px;">
            <div class="card shadow rounded-4">
                <div class="card-body">
                    <form action="{{ isset($tugas) ? route('tugas.update', $tugas->id) : route('tugas.store') }}" method="POST">
                        @csrf
                        @if(isset($tugas))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Judul Tugas</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $tugas->judul ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $tugas->deskripsi ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prioritas</label>
                            <select name="prioritas" class="form-control" required>
                                @foreach(['Tinggi', 'Sedang', 'Rendah'] as $p)
                                <option value="{{ $p }}" {{ old('prioritas', $tugas->prioritas ?? '') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                @foreach(['Menunggu', 'Sedang Dikerjakan', 'Selesai', 'Batal'] as $s)
                                <option value="{{ $s }}" {{ old('status', $tugas->status ?? '') == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Batas Waktu</label>
                            <input type="date" name="batas_waktu" class="form-control" value="{{ old('batas_waktu', isset($tugas) && $tugas->batas_waktu ? $tugas->batas_waktu->format('Y-m-d') : '') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">{{ isset($tugas) ? 'Update' : 'Simpan' }}</button>
                            <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
