@extends('app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Jumlah Pasien</h5>
                </div>
                <div class="card-body">
                    <h1>{{ $pasien }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Jumlah Rumah Sakit</h5>
                </div>
                <div class="card-body">
                    <h1>{{ $rumah_sakit }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
