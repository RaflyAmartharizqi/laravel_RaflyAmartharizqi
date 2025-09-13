@extends('app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tambah Data Rumah Sakit</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('rumah-sakit.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nama_rumah_sakit" class="form-label">Nama Rumah Sakit</label>
                    <input type="text" class="form-control" id="nama_rumah_sakit" name="nama_rumah_sakit" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_rumah_sakit" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat_rumah_sakit" name="alamat_rumah_sakit" required>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
