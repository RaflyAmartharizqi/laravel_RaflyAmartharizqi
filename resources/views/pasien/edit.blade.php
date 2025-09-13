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
            <h5>Edit Data Pasien</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pasien.update', $pasien->id_pasien) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ $pasien->nama_pasien }}" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_pasien" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat_pasien" name="alamat_pasien" value="{{ $pasien->alamat_pasien }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{ $pasien->no_telp }}" required>
                </div>
                <div class="mb-3">
                    <label for="id_rumah_sakit" class="form-label">Rumah Sakit</label>
                    <select class="form-select" id="id_rumah_sakit" name="id_rumah_sakit" required>
                        <option value="">Pilih Rumah Sakit</option>
                        @foreach($rumah_sakit as $rs)
                            <option value="{{ $rs->id_rumah_sakit }}" {{ $rs->id_rumah_sakit == $pasien->id_rumah_sakit ? 'selected' : '' }}>{{ $rs->nama_rumah_sakit }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
